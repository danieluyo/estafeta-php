<?php

namespace Ivansabik\Estafeta;

class Parsetafeta {
    
    private $_nodosTexto, $_tablas;
    
    function nodosTexto($nodosTexto) {
        $this->nodosTexto = $nodosTexto;
    }
    
    function tablas($tablas) {
        $this->tablas = $tablas;
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
        return $this->_parseCampoTexto('Destino');
        #todo: Falta CP destino y coordenadas
    }
    
    function servicio() {
        return $this->_parseCampoTexto('Servicio');
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
    }
    
    function costosEnvio() {
    }
    
    function _parseCampoTexto($descripcion, $coincidenciaExacta = false) {        
        for ($i = 0; $i < count($this->nodosTexto) - 1; $i++) {
            $nodoTexto = $this->nodosTexto[$i];
            $match = preg_match('/' . $descripcion . '\b/i', $nodoTexto);
            if ($match) {
                $resultado = $this->nodosTexto[$i + 1];
                $descripcion = $nodoTexto;
                return $resultado;
            }
        }
        return false;
    }
}
