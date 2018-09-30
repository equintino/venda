<?php
class Usuario extends Pessoa{
    private $login;
    private $senha;
    private $funcao;
    
    
    public function confCripto($nova,$salva) {
        $rst = crypt($nova,$salva) == $salva;
        return $rst;
    }
    public function cripto($d){
        return crypt($d);
    }
    public function getLogin() {
        return $this->login;
    }
    public function getSenha() {
        return $this->senha;
    }
    public function getFuncao() {
        return $this->funcao;
    }
    public function setLogin($login) {
        $this->login = $login;
    }
    public function setSenha($senha) {
        $this->senha = crypt($senha);
    }
    public function setFuncao($funcao) {
        $this->funcao = $funcao;
    }
}