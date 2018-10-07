<meta charset="utf8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel='stylesheet' href='../web/css/bootstrap.min.css' type='text/css' />
<script type='text/javascript' src='../web/js/jquery-3.3.1.min.js'></script>
<script type='text/javascript' src='../web/js/bootstrap.min.js'></script>
<?php
$origem = array_key_exists('origem',$_GET)?$_GET['origem']:null;
require_once '../config/Config.php';
require_once '../dao/Dao.php';
require_once '../dao/CriterioBusca.php';
require_once '../model/Model.php';
require_once '../classes/Mensagem.php';
require_once '../classes/Pessoa.php';
require_once '../classes/Usuario.php';
require_once '../classes/Produto.php';
require_once '../classes/Despesa.php';
require_once '../classes/Venda.php';
require_once '../classes/Session.php';

$dao = new Dao();
$model = new Model();
$mensagem = new Mensagem();
$session = new Session();
$usuario = new Usuario();
$produto = new Produto();
$despesa = new Despesa();
$venda = new Venda();
$search = new CriterioBusca();

if($origem=="cad_pessoa"):    
    $model->setTabela("tb_usuario");
    $usuario->setEmail($_POST['email']);
    $usuario->setSenha($_POST['senha']);
    $usuario->setNome($_POST['nome']);
    $usuario->setLogin($_POST['login']);
    $usuario->setFuncao($_POST['funcao']);
    
    $model->setArray($usuario);
    $dao->setExcecao(array('login'=>'varchar(50) NOT NULL UNIQUE'));
    $mensagem->setMsg($dao->grava($model));
    if($usuario->confCripto("provisorio", $_SESSION['login'])):
        header("Location:../web/sair.php");
    endif;
elseif($origem=="cad_prod"):
    $model->setTabela("tb_produto");
    $produto->setNome($_POST['nome']);
    $produto->setTipo($_POST['tipo']);
    $produto->setCusto(converte($_POST['custo']));
    $produto->setPreco(converte($_POST['preco']));
    $produto->setQtdPromo($_POST['qtd_promo']);
    $produto->setVlrPromo(converte($_POST['vlr_promo']));
    $produto->setDescricao($_POST['descricao']);
    
    $model->setId($_POST['codProd']);
    $model->setArray($produto);
    $dao->setExcecao(array('tipo'=>'varchar(50) NOT NULL UNIQUE KEY'));
    grava($dao->grava($model));

elseif($origem=="cad_desp"):
    $model->setTabela("tb_despesa");
    $despesa->setTipo($_POST['tipo']);
    $despesa->setValor(converte($_POST['valor']));
    $despesa->setFreq($_POST['freq']);
    
    $model->setArray($despesa);
    grava($dao->grava($model));

elseif($origem=="cad_venda"):
    $search->setTabela("tb_produto");
    $perDe = $_POST['periodoDe'];
    $perA = $_POST['periodoA'];
    
    $model->setTabela("tb_venda");
    foreach($_POST as $key => $value){
        if($key != 'periodoDe' && $key != 'periodoA'){
            $search->setArray(array('tipo'=>$key));
            foreach($dao->encontre($search) as $key2 => $value2){
                if($value > 0){
                    $idProd=$key2;
                    $venda->setPerDe($perDe);
                    $venda->setPerA($perA);
                    $venda->setQtd($value);
                    $venda->setIdProd($idProd);
                    $model->setArray($venda);
                    $dao->grava($model);
                }
            }
        }
    }
echo '<script>alert("Registro de Vendas Realizado");history.go(-1)</script>';
elseif($origem=="venda_sobra"):
    echo '<pre>';print_r($_POST);
endif;
function grava($dados){
    if($dados): ?>
        <div class='alert alert-success' role='alert'>
            <h2>Cadastro realizado com sucesso.</h2>
            <button class='btn btn-success' onclick='history.go(-1)'>Voltar</button>
        </div>
    <?php else: ?>
        <div class='alert alert-danger' role='alert'>
            <h2>Ops! Alguma coisa deu errado.</h2>
            <button class='btn btn-danger' onclick='history.go(-1)'>Voltar</button>
        </div>
    <?php endif;
}
function converte($vlr){
    $int=str_replace('.','',$vlr);
    $rst=str_replace(',','.',$int);
    return $rst;
}
function moeda($vlr){
    $int=str_split(strstr($vlr,',',true));
    $cent=substr(strstr($vlr,','),1);
    $x=count($int);
    $mil=1;
    $rst=null;
    while($x > 0){
        if($int[--$x] != '.'){
            if($mil!=3){
                $rst .=$int[$x];
                $mil++;
            }else{
                $rst .=$int[$x].'.';
                $mil=1;
            }
        }
    }
    return $vlr=strrev($rst).','.$cent;
}       