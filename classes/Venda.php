<?php
class Venda {
    private $produto;
    private $perDe;
    private $perA;
    private $qtd;
    private $idProd;
   
    public function somaQtd($qtd){
        $this->setQtd($this->getQtd()+$qtd);
    }
    public function getProduto() {
        return $this->produto;
    }
    public function setProduto(Produto $produto) {
        $this->produto = $produto;
    }
    public function getPerDe() {
        return $this->perDe;
    }
    public function getPerA() {
        return $this->perA;
    }
    public function getQtd() {
        return $this->qtd;
    }
    public function setPerDe($perDe) {
        $this->perDe = $perDe;
    }
    public function setPerA($perA) {
        $this->perA = $perA;
    }
    public function setQtd($qtd) {
        $this->qtd = $qtd;
    }
    public function getIdProd() {
        return $this->idProd;
    }
    public function setIdProd($idProd) {
        $this->idProd = $idProd;
    }
}