<?php
class Pessoa {
    private $nome;
    private $cpf;
    private $email;
    private $tel;
    private $cel;
    private $nascimento;
    private $sexo;
   
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
    public function getNascimento() {
        return $this->nascimento;
    }
    public function setNascimento($nascimento) {
        $this->nascimento = $nascimento;
    }
    public function getSexo() {
        return $this->sexo;
    }
    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }
}