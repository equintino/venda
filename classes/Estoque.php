<?php
class Estoque {
    private $atual;
    private $min;
    private $produto;
   
    public function getAtual() {
        return $this->atual;
    }
    public function getMin() {
        return $this->min;
    }
    public function getProduto() {
        return $this->produto;
    }
    public function setAtual($atual) {
        $this->atual = $atual;
    }
    public function setMin($min) {
        $this->min = $min;
    }
    public function setProduto(Produto $produto) {
        $this->produto = $produto;
    }
}