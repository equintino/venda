<?php
class CriterioBusca {
    private $tabela;
    private $id;
    private $array;
   
    public function getTabela() {
        return $this->tabela;
    }
    public function getId() {
        return $this->id;
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
    public function setArray(array $array) {
        $this->array = $array;
    }
}