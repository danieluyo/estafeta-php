<?php

namespace Ivansabik\Estafeta;

define('URL_RASTREAR', 'http://rastreo3.estafeta.com/RastreoWebInternet/consultaEnvio.do');
define('URL_COTIZAR', 'http://herramientascs.estafeta.com/Cotizador/Cotizar');
define('URL_FIRMA', 'http://rastreo3.estafeta.com');
define('URL_COMPROBANTE', 'http://rastreo3.estafeta.com/RastreoWebInternet/consultaEnvio.do?dispatch=doComprobanteEntrega&guiaEst=');

class Estafeta {
    
    private $_cotizar, $_html, $_dom;

    function rastrear($numero) {
        #todo: Manejo de error cuando no existe html o número de rastreo
        $tipoNumero = $this->_valida_numero($numero);
        $paramsPost = array(
            'idioma' => 'es',
            'dispatch' => 'doRastreoInternet',
            'guias' => $numero
        );
        if ($tipoNumero == 'guia') {
            $paramsPost['tipoGuia'] = 'ESTAFETA';
        } elseif ($tipoNumero == 'rastreo') {
            $paramsPost['tipoGuia'] = 'REFERENCE';
        } elseif ($tipoNumero == 'invalido') {
            throw new \Exception('No es un número de guía o código de rastreo válido');
        }
        # El if nada más para testing
        if(!$this->_html) {
            $html = $this->_curlHtml(URL_RASTREAR, $paramsPost);
            $this->_html($html);
        }
        print_r($this->_nodosTexto());
    }
    
    function cotizar($cpOrigen=NULL, $cpDestino=NULL, $peso=NULL, $alto=NULL, $largo=NULL, $ancho=NULL) {
        if (!$cpOrigen) throw new \Exception('Falta el parametro cp_origen');
        if (!$cpDestino) throw new \Exception('Falta el parametro cp_destino');
        if (!preg_match("/^[0-9]{5}$/", $cpOrigen) || !preg_match("/^[0-9]{5}$/", $cpDestino)) throw new \Exception('No es un codigo postal de origen o destino valido');
        $tipo = ($peso ? 'paquete' : 'sobre');
        $paramsPost = array(
            'CPOrigen' => $cpOrigen,
            'CPDestino' => $cpDestino,
            'Tipo' => $tipo,
            'cTipoEnvio' => $tipo
        );

        # Paquetes
        if ($tipo == 'paquete') {
            if (!$peso) throw new \Exception('Falta el parametro "peso" para cotizar paquetes');
            if (!$alto) throw new \Exception('Falta el parametro "alto" para cotizar paquetes');
            if (!$largo) throw new \Exception('Falta el parametro "largo" para cotizar paquetes');
            if (!$ancho) throw new \Exception('Falta el parametro "ancho" para cotizar paquetes');
            $paramsPost['Peso'] = $peso;
            $paramsPost['Alto'] = $alto;
            $paramsPost['Largo'] = $largo;
            $paramsPost['Ancho'] = $ancho;
        }
        
        # El if nada más para testing
        if(!$this->_html) {
            $html = $this->_curlHtml(URL_COTIZAR, $paramsPost);
            $this->_html($html);
        }
        print_r($this->_nodosTexto());
    }
    
    private function _html($html) {
        #todo: Validar que HTML se pueda parsear con módulo DOM
        $this->_html = $html;
        $this->dom = new \DOMDocument();
        $this->dom->loadHTML($html);
    }
    
    private function _nodosTexto(){
        #todo: Convertir cualquier encoding a UTF8
        $nodos = array();
        $xpath = new \DOMXPath($this->dom);
        $nodosTexto = $xpath->query('//text()');
        foreach($nodosTexto as $nodoTexto) $nodos[]=$nodoTexto->textContent;
    }

    private function _curlHtml($url, $params) {        
        #todo: Manejo de error cuando no existe curl_init()
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_VERBOSE, true);
        curl_setopt($curl, CURLOPT_POST, true);        
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        $html = curl_exec($curl);
        curl_close($curl);
        return $html;
    }

    private function _valida_numero($numero) {
        # Número de guía (22 y alfanumérico), código de rastreo (10 y numérico)
        if (strlen($numero) == 22 && ctype_alnum(($numero))) return 'guia';
        if (strlen($numero) == 10 && is_numeric(($numero))) return 'rastreo';
        return 'invalido';
    }

    private function _asigna_id_movimiento($texto) {
        # En proceso de entrega
        if (preg_match('/\bEN PROCESO DE ENTREGA\b/i', $texto)) return 1;
        # Llegada a CEDI
        if (preg_match('/\bLLEGADA A CENTRO DE DISTRIBUCI\b/i', $texto)) return 2;
        # En ruta foránea  hacia un destino
        if (preg_match('/\bEN RUTA FOR\b/i', $texto)) return 3;
        # Recolección en oficina por ruta local
        if (preg_match('/\bN EN OFICINA\b/i', $texto)) return 4;
        # Recibido en oficina
        if (preg_match('/\bRECIBIDO EN OFICINA\b/i', $texto)) return 5;
        # Movimiento en CEDI
        if (preg_match('/\bMOVIMIENTO EN CENTRO DE DISTRIBUCI\b/i', $texto)) return 6;
        # Aclaracion en proceso
        if (preg_match('/\bN EN PROCESO\b/i', $texto)) return 7;
        # En ruta local
        if (preg_match('/\bEN RUTA LOCAL\b/i', $texto)) return 8;
        # Movimiento local
        if (preg_match('/\bMOVIMIENTO LOCAL\b/i', $texto)) return 9;
        return -1;
    }

}

?>
