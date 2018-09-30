<?php
class Dao {
    private $db;
    private $excecao;
    
    public function __destruct() {
        $this->db = null;
    }
    public function encontre(CriterioBusca $search){
        $sql = $this->getSql($search);
        $rst = $this->query($sql);
        if($rst){
            $dados = $rst->fetchAll();
            foreach($dados as $row){
                $model = new Model();
                $model->setArray($row);
                $result[$row['id']]=$model;
            }
        }else{
            return null;
        }
        $result = isset($result)?$result:null;
        return $result;
    }
    public function grava(Model $model){
        if($model->getId()!=null){
            return $this->getUpdate($model);
        }
        return $this->getInsert($model);
    }
    private function getDb(){
        if($this->db != null){
            return $this->db;
        }
        $config = Config::getConfig("db");
        try{
            $this->db = new PDO($config['dsn'],$config['usuario'],$config['senha'],array(PDO::MYSQL_ATTR_INIT_COMMAND=> "SET NAMES utf8"));
        } catch (Exception $ex) {
            $mensagem = new Mensagem();
            $mensagem->setMsg(null);
            exit;
        }
        return $this->db;
    }
    private function query($sql){
        try{
            $stmt = $this->getDb()->query($sql, PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
        if(empty($stmt)){
            return false;
        }
        return $stmt;
    }
    private function getSql(CriterioBusca $search){
        $sql = "SELECT * FROM ".$search->getTabela()." WHERE ";
        $arr = $search->getArray();
        if(count($arr) != 0){
            $login = array_key_exists('login',$arr)?trim($arr['login']):null;
        }
        if(isset($login) && count($arr)==1){
            $sql .= 'login = "'.$login.'" AND';
        }elseif(count($arr) != 0){
            foreach($arr as $key => $value){
                $sql .= "$key = '$value' AND";
            }
        }
        $sql .= " excluido = '0'";
        Return $sql;
    }
    private function getInsert(Model $model){
        date_default_timezone_set("America/Sao_Paulo");
        $model->setCriado(date("Y-m-d H:i:s"));
        $model->setExcluido('0');
        $sql = "INSERT INTO ".$model->getTabela()." ";
        $col = "criado,";
        $value = "'".$model->getCriado()."',";
        foreach($this->getParams($model) as $key => $item){
            $col .= str_replace(":","",$key).",";
            $value .= "$key,";
        }
        $col .= "excluido ";
        $value .= "'0'";
        $sql .= "($col) VALUES ($value)";
        $this->criaTabela($model);
        return $this->execute($sql, $model);
    }
    private function getUpdate(Model $model){
        
        return $result;
    }
    private function execute($sql,Model $model=null){
        $stmt = $this->getDb()->prepare($sql);
        if(!$stmt->execute($this->getParams($model))){
            return false;
        }
        return true;
    }
    private function executeStatment(PDOStatement $stmt, array $params){
        if(!$stmt->execute($params)){
            return false;
        }else{
            return true;
        }        
    }
    private function getParams(Model $model){
        $params = null;
        $metodos=get_class_methods($model->getArray());
        foreach($metodos as $metodo){
            if(substr($metodo,0,3)=="get"){
                $value=$model->getArray()->$metodo();
                $col=strtolower(str_replace("get",":",$metodo));
                $params[$col] = $value;
            }
        }
        return $params;        
    }
    public function showTabela(){
        $sql = "SELECT * FROM INFORMATION_SCHEMA.TABLES";
        print_r($this->getDb());die;
        return $this->query($sql)->fetchAll();
    }
    public function criaTabela(Model $model){
        $sql = "CREATE TABLE IF NOT EXISTS ".$model->getTabela()." (id INT(5) NOT NULL AUTO_INCREMENT, criado datetime NOT NULL, modificado datetime NULL, ";
        foreach($this->getParams($model) as $key => $value){
            $key = str_replace(':','',$key);
            $exc = count($this->getExcecao()) > 0? $this->getExcecao():array();
            if(!array_key_exists($key, $exc)){
                $sql .= "".$key." varchar(100) NULL, ";
            }else{
                $sql .= "$key ".$this->getExcecao()[$key].", ";
            }
        }
        $sql .= "excluido ENUM('0','1') NOT NULL DEFAULT \"0\", PRIMARY KEY (id)) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci";
        return $this->query($sql);
    }
    public function getExcecao() {
        return $this->excecao;
    }
    public function setExcecao(array $excecao) {
        $this->excecao = $excecao;
    }
}