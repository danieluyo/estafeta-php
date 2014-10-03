<?php

namespace Ivansabik\Estafeta;

class Parsetafeta {
    
    private $_nodosTexto, $_tablas, $_imagenes;
    
    function nodosTexto($nodosTexto) {
        $this->_nodosTexto = $nodosTexto;
    }
    
    function tablas($tablas) {
        $this->_tablas = $tablas;
    }
    
    function imagenes($imagenes) {
        $this->_imagenes = $imagenes;
    }
    
    function numGuia() {
        return $this->_parseCampoTexto('mero de gu');
    }
    
    function codigoRastreo() {
        return $this->_parseCampoTexto('digo de rastreo');
    }
    
    function origen() {
        return $this->_parseCampoTexto('Origen');
        #todo: Falta CP destino y coordenadas
    }
    
    function destino() {
        return $this->_parseCampoTexto('Destino', true);
        #todo: Falta CP destino y coordenadas
    }
    
    function servicio() {
        return $this->_parseDescCampoTexto('entrega garantizada');
    }
    
    function estatus() {
        return $this->_parseCampoTexto('Estatus del servicio');
    }
    
    function fechaRecoleccion() {
        return $this->_parseCampoTexto('Fecha de recolecci');
    }
    
    function fechaProgramada() {
        return $this->_parseCampoTexto('de entrega');
    }
    
    function fechaEntrega() {
        return $this->_parseCampoTexto('Fecha y hora de entrega');
    }
    
    function tipoEnvio() {
        return $this->_parseCampoTexto('Tipo de env');
    }
    
    function peso() {
        return $this->_parseCampoTexto('Peso kg');
    }
    
    function pesoVol() {
        return $this->_parseCampoTexto('Peso volum');
    }
    
    function recibio() {
    }
    
    function movimientos() {
    }
    
    function firmaRecibido() {
        return $this->_parseImagen('firmaServlet');
    }
    
    function costosEnvio() {
    }
    
    #todo: Se podría juntar en 1 sola función
    private function _parseCampoTexto($descripcion, $coincidenciaExacta = false) {        
        for ($i = 0; $i < count($this->_nodosTexto) - 1; $i++) {
            $nodoTexto = $this->_nodosTexto[$i];
            if($coincidenciaExacta) $match = preg_match('/^' . $descripcion . '/', $nodoTexto);
            else $match = preg_match('/' . $descripcion . '\b/i', $nodoTexto);
            if($match) return $this->_nodosTexto[$i + 1];
        }
        return false;
    }
    
    private function _parseDescCampoTexto($descripcion, $coincidenciaExacta = false) {        
        for ($i = 0; $i < count($this->_nodosTexto) - 1; $i++) {
            $nodoTexto = $this->_nodosTexto[$i];
            if($coincidenciaExacta) $match = preg_match('/^' . $descripcion . '/', $nodoTexto);
            else $match = preg_match('/' . $descripcion . '\b/i', $nodoTexto);
            if($match) return $this->_nodosTexto[$i];
        }
        return false;
    }
    
    private function _parseImagen($descripcion, $coincidenciaExacta = false) {
        for ($i = 0; $i < count($this->_imagenes) - 1; $i++) {
            $imagen = $this->_imagenes[$i];
            if($coincidenciaExacta) $match = preg_match('/^' . $descripcion . '/', $imagen);
            else $match = preg_match('/' . $descripcion . '\b/i', $imagen);
            if($match) return $this->_imagenes[$i];
        }
        return false;
    }
    
}
