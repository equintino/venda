<?php
class Mensagem {
    private $msg;
    
    public function getMsg() {
        return $this->msg;
    }
    public function setMsg($dados) {
        if($dados): ?>
        <div class='alert alert-success' role='alert'>
            <h2>Cadastro realizado com sucesso.</h2>
            <button class='btn btn-success' onclick='history.go(-1)'>Voltar</button>
        </div>
    <?php else: ?>
        <div class='alert alert-danger' role='alert'>
            <h2>Ops! Erro na conexão com o banco.</h2>
            <button class='btn btn-danger' onclick='history.go(-1)'>Voltar</button>
        </div>
    <?php endif;
        $this->msg = $dados;
    }
}