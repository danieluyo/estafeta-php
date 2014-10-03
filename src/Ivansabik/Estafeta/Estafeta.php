<?php

namespace Ivansabik\Estafeta;

error_reporting(0);


use Ivansabik\Estafeta\Parsetafeta;

define('URL_RASTREAR', 'http://rastreo3.estafeta.com/RastreoWebInternet/consultaEnvio.do');
define('URL_COTIZAR', 'http://herramientascs.estafeta.com/Cotizador/Cotizar');
define('URL_FIRMA', 'http://rastreo3.estafeta.com');
define('URL_COMPROBANTE', 'http://rastreo3.estafeta.com/RastreoWebInternet/consultaEnvio.do?dispatch=doComprobanteEntrega&guiaEst=');
define('URL_FIRMA', 'http://rastreo3.estafeta.com');

#todo: pasar dom a Parsetafeta para que se haga dentro de esa clase todo el manejo
class Estafeta {
    
    public $infoEnvio, $cotizacion;
    private $_html, $_dom;

    function rastrear($numero) {
        #todo: Manejo de error cuando no existe html o número de rastreo
        $tipoNumero = $this->_valida_numero($numero);
        $paramsPost = array(
            'idioma' => 'es',
            'dispatch' => 'doRastreoInternet',
            'guias' => $numero
        );
        if ($tipoNumero == 'guia') $paramsPost['tipoGuia'] = 'ESTAFETA';
        elseif ($tipoNumero == 'rastreo') $paramsPost['tipoGuia'] = 'REFERENCE';
        
        # El if sólo es para modo testing, que no haga cURL
        if(!$this->_html) {
            $html = $this->_curlHtml(URL_RASTREAR, $paramsPost);
            $this->_html($html);
        }
        # Parse de campos
        $nodosTexto = $this->_nodosTexto();
        $imagenes = $this->_imagenes();
        $infoEnvio = array();
        $parsetafeta = new Parsetafeta();
        $parsetafeta->nodosTexto($nodosTexto);
        $parsetafeta->imagenes($imagenes);
        $infoEnvio['numero_guia'] = $parsetafeta->numGuia();
        $infoEnvio['codigo_rastreo'] = $parsetafeta->codigoRastreo();
        $infoEnvio['origen'] = $parsetafeta->origen();
        $infoEnvio['destino'] = $parsetafeta->destino();
        $infoEnvio['servicio'] = $parsetafeta->servicio();
        $infoEnvio['estatus'] = $parsetafeta->estatus();
        $infoEnvio['fecha_recoleccion'] = $parsetafeta->fechaRecoleccion();
        $infoEnvio['fecha_programada'] = $parsetafeta->fechaProgramada();
        $infoEnvio['fecha_entrega'] = $parsetafeta->fechaEntrega();
        $infoEnvio['tipo_envio'] = $parsetafeta->tipoEnvio();
        $infoEnvio['peso'] = $parsetafeta->peso();
        $infoEnvio['peso_volumetrico'] = $parsetafeta->pesoVol();
        $infoEnvio['recibio'] = $parsetafeta->recibio();
        $infoEnvio['movimientos'] = $parsetafeta->movimientos();
        $infoEnvio['firma_recibido'] = URL_FIRMA . $parsetafeta->firmaRecibido();
        $this->infoEnvio = $infoEnvio;
    }
    
    function cotizar($cpOrigen=null, $cpDestino=null, $peso=null, $alto=null, $largo=null, $ancho=null) {
        if (!$cpOrigen) throw new \Exception('Falta el argumento cpOrigen para cotizar');
        if (!$cpDestino) throw new \Exception('Falta el argumento cpDestino para cotizar');
        if (!preg_match("/^[0-9]{5}$/", $cpOrigen) || !preg_match("/^[0-9]{5}$/", $cpDestino)) throw new \Exception('Código postal de origen o destino no válido');
        $tipo = ($peso ? 'paquete' : 'sobre');
        $paramsPost = array(
            'CPOrigen' => $cpOrigen,
            'CPDestino' => $cpDestino,
            'Tipo' => $tipo,
            'cTipoEnvio' => $tipo
        );

        # Paquetes
        if ($tipo == 'paquete') {
            if (!$peso) throw new \Exception('Falta el argumento peso para cotizar paquetes');
            if (!$alto) throw new \Exception('Falta el argumento alto para cotizar paquetes');
            if (!$largo) throw new \Exception('Falta el argumento largo para cotizar paquetes');
            if (!$ancho) throw new \Exception('Falta el argumento ancho para cotizar paquetes');
            $paramsPost['Peso'] = $peso;
            $paramsPost['Alto'] = $alto;
            $paramsPost['Largo'] = $largo;
            $paramsPost['Ancho'] = $ancho;
        }
        
        # El if sólo es para modo testing, que no haga cURL
        if(!$this->_html) {
            $html = $this->_curlHtml(URL_COTIZAR, $paramsPost);
            $this->_html($html);
        }
        
        $nodosTexto = $this->_nodosTexto();
        $cotizacion = array();
        $parsetafeta = new Parsetafeta();
        $parsetafeta->nodosTexto($nodosTexto);
        $cotizacion['costos_envio'] = $parsetafeta->costosEnvio();
        $this->cotizacion = $cotizacion;
    }
    
    private function _html($html) {
        #$html = iconv(mb_detect_encoding($html, mb_detect_order(), true), 'UTF-8', $html);
        $this->_html = $html;
        $this->_dom = new \DOMDocument();
        $this->_dom->loadHTML($html);
    }
    
    private function _nodosTexto(){
        $nodos = array();
        $xpath = new \DOMXPath($this->_dom);
        $nodosTexto = $xpath->query('//text()');
        foreach($nodosTexto as $nodoTexto) {
            $nodoTexto = $nodoTexto->textContent;
            $nodos[] = trim($nodoTexto);
        }
        # Quita vacíos '', Vuelve a indexar arreglo (0,1,2..)
        $nodos = array_filter($nodos);
        $nodos = array_values($nodos);
        return $nodos;
    }
    
    private function _imagenes(){
        $nodos = array();
        $xpath = new \DOMXPath($this->_dom);
        $imagenes = array();
        $imagenesDom = $xpath->query('//img');
        foreach($imagenesDom as $imagenDom) {
            $imagen = $imagenDom->getAttribute('src');
            $imagenes[] = $imagen;
        }
        return $imagenes;
    }

    private function _curlHtml($url, $params) {        
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
        throw new \Exception('No es un número de guía o código de rastreo válido');
    }

    private function _asigna_id_movimiento($texto) {
        if (preg_match('/\bEN PROCESO DE ENTREGA\b/i', $texto)) return 1;
        if (preg_match('/\bLLEGADA A CENTRO DE DISTRIBUCI\b/i', $texto)) return 2;
        if (preg_match('/\bEN RUTA FOR\b/i', $texto)) return 3; # En ruta foránea  hacia un destino
        if (preg_match('/\bN EN OFICINA\b/i', $texto)) return 4; # Recolección en oficina por ruta local
        if (preg_match('/\bRECIBIDO EN OFICINA\b/i', $texto)) return 5;
        if (preg_match('/\bMOVIMIENTO EN CENTRO DE DISTRIBUCI\b/i', $texto)) return 6;
        if (preg_match('/\bN EN PROCESO\b/i', $texto)) return 7; # Aclaracion en proceso
        if (preg_match('/\bEN RUTA LOCAL\b/i', $texto)) return 8;
        if (preg_match('/\bMOVIMIENTO LOCAL\b/i', $texto)) return 9;
        return false;
    }
    
}
