<?php
//session_start();
require_once "../dao/Dao.php";
require_once "../classes/Session.php";
require_once "../classes/Despesa.php";
require_once "../classes/Venda.php";
require_once "../classes/Produto.php";
require_once "../dao/CriterioBusca.php";
require_once "../config/Config.php";
require_once "../model/Model.php";

class Index {
    
}
$session = new Session();
if($_SESSION['login']){
    require_once "../layout/index.php";
}else{
    header("Location:../index.html");
}