<?php

define('URL_RASTREAR', 'http://rastreo3.estafeta.com/RastreoWebInternet/consultaEnvio.do');
define('URL_COTIZAR', 'http://herramientascs.estafeta.com/Cotizador/Cotizar');
define('URL_FIRMA', 'http://rastreo3.estafeta.com');
define('URL_COMPROBANTE', 'http://rastreo3.estafeta.com/RastreoWebInternet/consultaEnvio.do?dispatch=doComprobanteEntrega&guiaEst=');

class Estafeta {
    
    private $_cotizar;

    function rastrear($numero = NULL) {
    }
    
    function cotizar($cp_origen = NULL, $cp_destino = NULL, $tipo = 'sobre', $peso = NULL, $alto = NULL, $largo = NULL, $ancho = NULL) {
    }

    private function _valida_numero($numero) {
        # Numero de guia (22 y alfanumérico)
        if (strlen($numero) == 22 && ctype_alnum($numero)) return 'guia';
        # Codigo de rastreo (10 y numérico)
        if (strlen($_GET['numero']) == 10 && is_numeric($numero)) return 'rastreo';
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
