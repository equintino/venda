<?php
class Despesa {
    private $tipo;
    private $valor;
    private $freq;
  
    public function getTipo() {
        return $this->tipo;
    }
    public function getValor() {
        return $this->valor;
    }
    public function getFreq() {
        return $this->freq;
    }
    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }
    public function setValor($valor) {
        $this->valor = $valor;
    }
    public function setFreq($freq) {
        $this->freq = $freq;
    }
}