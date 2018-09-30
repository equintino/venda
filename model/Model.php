<?php
class Model {
    private $tabela;
    private $id;
    private $criado;
    private $modificado;
    private $excluido;
    private $array;
   
    public function getTabela() {
        return $this->tabela;
    }
    public function getId() {
        return $this->id;
    }
    public function getCriado() {
        return $this->criado;
    }
    public function getModificado() {
        return $this->modificado;
    }
    public function setCriado($criado) {
        $this->criado = $criado;
    }
    public function setModificado($modificado) {
        $this->modificado = $modificado;
    }
    public function getExcluido() {
        return $this->excluido;
    }
    public function setExcluido($excluido) {
        $this->excluido = $excluido;
    }
    public function getArray() {
        return $this->array;
    }
    public function setTabela($tabela) {
        $this->tabela = $tabela;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function setArray($array) {
        $this->array = $array;
    }
}