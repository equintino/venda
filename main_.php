<link rel="stylesheet" href="web/css/bootstrap.css" type="text/css" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf8"/>
<?php
require_once "dao/Dao.php";
require_once "config/Config.php";
require_once "dao/CriterioBusca.php";
require_once "model/Model.php";
require_once "classes/Pessoa.php";
require_once "classes/Usuario.php";
require_once "classes/Session.php";

$login = array_key_exists('login',$_POST)?$_POST['login']:null;
$senha = array_key_exists('senha',$_POST)?$_POST['senha']:null;
$lembrete = array_key_exists('lembrete',$_POST)?$_POST['lembrete']:'';
$dao = new Dao();
$search = new CriterioBusca();
$usuario = new Usuario();
$search->setTabela("tb_usuario");
$search->setArray(array('login'=>$login));
$dados = $dao->encontre($search);
if(isset($dados)){
    foreach($dados as $value){
        $senhaDb=$value->getArray()['senha'];
        $login=$value->getArray()['login'];
    }
}
$ok=isset($senhaDb)?$usuario->confCripto($_POST['senha'],$senhaDb):null;
if($ok):
    $session = new Session();
    $session->setLogin($login);
    if($lembrete == 'SIM'):
	$expira = time() + 60*60*24*30; 
	setCookie('CookieLembrete', base64_encode('SIM'), $expira);
	setCookie('CookieLogin', base64_encode($login), $expira);
	setCookie('CookieSenha', base64_encode($senha), $expira);
    else:
	setCookie('CookieLembrete');
	setCookie('CookieLogin');
	setCookie('CookieSenha');
    endif;
    header("Location: web/index.php");
else:
?>
<div class="alert-warning text-center">
    <h3>Login ou Senha não confere.</h3>
    <button class="btn btn-warning" style="color:white;text-shadow:1px 1px 1px gray;;" onclick="history.go(-1)">VOLTAR</button>
</div>
<?php exit; endif;