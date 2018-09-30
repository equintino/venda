<?php
class Produto {
    private $codProd;
    private $nome;
    private $descricao;
    private $tipo;
    private $custo;
    private $preco;
    private $qtdPromo;
    private $vlrPromo;
   
    public function getCodProd() {
        return $this->codProd;
    }
    public function getNome() {
        return $this->nome;
    }
    public function getDescricao() {
        return $this->descricao;
    }
    public function getTipo() {
        return $this->tipo;
    }
    public function getCusto() {
        return $this->custo;
    }
    public function getPreco() {
        return $this->preco;
    }
    public function getQtdPromo() {
        return $this->promo;
    }
    public function setCodProd($codProd) {
        $this->codProd = $codProd;
    }
    public function setNome($nome) {
        $this->nome = $nome;
    }
    public function setDescricao($desc) {
        $this->descricao = $desc;
    }
    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }
    public function setCusto($custo) {
        $this->custo = $custo;
    }
    public function setPreco($preco) {
        $this->preco = $preco;
    }
    public function setQtdPromo($promo) {
        $this->promo = $promo;
    }
    public function getVlrPromo() {
        return $this->vlrPromo;
    }
    public function setVlrPromo($vlrPromo) {
        $this->vlrPromo = $vlrPromo;
    }
}