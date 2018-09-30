<?php
class Pessoa {
    private $nome;
    private $cpf;
    private $email;
    private $tel;
    private $cel;
   
    public function getNome() {
        return $this->nome;
    }
    public function getCpf() {
        return $this->cpf;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getTel() {
        return $this->tel;
    }
    public function getCel() {
        return $this->cel;
    }
    public function setNome($nome) {
        $this->nome = $nome;
    }
    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setTel($tel) {
        $this->tel = $tel;
    }
    public function setCel($cel) {
        $this->cel = $cel;
    }
}