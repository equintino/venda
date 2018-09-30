<style>
    h2{
        text-shadow: 1px 1px 1px gray;
    }
    form label{
        font-weight: bolder;
    }
    table{
        text-align: center;
    }
</style>
<script>
    $(document).ready(function(){
        $("#senha2").blur(function(){
            if($("#senha").val() != $(this).val()){
                alert("senha não confere");
                $(this).addClass("is-invalid").focus();
            }else{
                $(this).removeClass("is-invalid");
                $(this).addClass("is-valid");
            }
        });
        $(".dinheiro").mask("#.##0,00",{reverse: true});
    });
</script>
<?php $act = array_key_exists('act',$_GET)?$_GET['act']:null; ?>
<?php if($act=='cad_pessoa'): ?>
<div class="container mt-5">
<h2>Cadastro de Acesso</h2>
    <form id="cad_pessoa" action="../paginas/add.php?origem=cad_pessoa" method="POST" class="form-horizontal">
        <div class="border border-secundary px-4 bg-light">
            <fieldset class="py-3">
                <div class="form-group form-row">
                    <div class="col-md">
                    <label for="nome" class="col-form-label">Nome Completo</label>
                    <input type="nome" class="form-control" id="nome" name="nome" placeholder="Digite seu nome" autofocus required/>
                    </div><!-- col -->
                    <div class="col-md">
                    <label for="email" class="col-form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Digite aqui seu e-mail" required/>
                    </div><!-- col -->
                    <div class="col-md-2">
                        <label for="funcao" class="col-form-label">Função:</label>
                        <select name="funcao" class="form-control">
                        <option value=""></option>
                        <option value="admin">Administrador</option>
                        <option value="vendedor">Vendedor</option>
                    </select>
                    </div><!-- col -->
                </div><!-- row -->
                <div class="form-group form-row">
                    <div class="col-md">
                    <label for="login" class="col-form-label">LOGIN</label>
                    <input type="login" class="form-control" id="login" name="login" placeholder="Digite aqui seu LOGIN" required/>
                    </div><!-- col -->
                    <div class="col-md">
                    <label for="senha" class="col-form-label">Senha de 6 digitos</label>
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha" required/>
                    </div><!-- col -->
                    <div class="col-md">
                    <label for="senha2" class="col-form-label">Confirme</label>
                    <input type="password" class="form-control" id="senha2" placeholder="Confirme sua senha" required/>
                    </div><!-- col -->
                </div><!-- row -->
            </fieldset>
        </div><!-- border -->
                <button class="btn btn-primary btn-sm" style="float: right">Enviar</button>
    </form>
</div>
<?php elseif($act=='cad_prod'): ?>
<div class="container mt-5">
    <h2>Cadastro de Produtos</h2>
    <form id="cad_prod" action="../paginas/add.php?origem=cad_prod" method="POST" class="form-horizontal">
        <div class="border border-secundary p-3 bg-light">
        <div class="form-group form-row">
            <div class="col-md-4">
            <label for="nome" class="col-form-label">Nome do Produto</label>
            <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome do produto" autofocus required/>
            </div>
            <div class="col-md">
            <label for="descricao" class="col-form-label">Descrição</label>
            <input type="text" class="form-control" id="descricao" name="descricao" placeholder="Descreva o produto" />
            </div>
            <div class="col-md-3">
                <label for="tipo" class="col-form-label">Tipo</label>
                <input type="text" class="form-control" id="tipo" name="tipo" placeholder="Digite o tipo do produto" required/>
            </div>
        </div><!-- form row -->
        <div class="form-group form-row">
            <div class="col-md">
                <label for="custo" class="col-form-label">Preço de Custo</label>
                <input type="text" class="form-control dinheiro" id="custo" name="custo" placeholder="Digite o preço de custo do produto" required/>
            </div>
            <div class="col-md">
                <label for="preco" class="col-form-label">Preço de Venda</label>
                <input type="text" class="form-control dinheiro" id="preco" name="preco" placeholder="Digite o valor de venda do produto" required/>
            </div>
        </div><!-- form row -->
        <div class="form-group form-row">
            <div class="col-md">
                <label for="qtd_promo" class="col-form-label">Promoção(Qtd)</label>
                <input type="number" class="form-control" id="qtd_promo" name="qtd_promo" placeholder="Quantidade de produto na promoção" required/>
            </div>
            <div class="col-md">
                <label for="vlr_promo" class="col-form-label">Preço na Promoção</label>
                <input type="text" class="form-control dinheiro" id="vlr_promo" name="vlr_promo" placeholder="Digite o valor da promoção" required/>
            </div>
        </div><!-- form row -->
        </div><!-- border -->
        <button class="btn btn-primary" style="float: right">Salvar</button>        
    </form>
</div>
<?php elseif($act=='lista'):
    require_once "../dao/Dao.php";
    
    $dao = new Dao();
    $search = new CriterioBusca();
    $search->setTabela("tb_produto");
    $dados=$dao->encontre($search);    
?>
<div class='container mt-5'>
<h2>Lista de Produtos</h2>
<table class='table table-bordered table-hover table-striped table-responsive-sm'>
    <thead class='bg-primary' style='color:white;text-shadow: 1px 1px 1px gray'>
    <tr>
        <th scope="col">PRODUTO</th>
        <th scope="col">DESCRIÇÃO</th>
        <th scope="col">TIPO</th>
        <th scope="col">CUSTO</th>
        <th scope="col">PREÇO</th>
        <th scope="col">PROMOÇÃO</th>
    </tr>
    </thead>
    <tbody>
        <?php 
            if(isset($dados)):
                foreach($dados as $dado): 
                ?>
    <tr>
        <td scope='row'><?= mb_strtoupper($dado->getArray()['nome'],'utf8') ?></td>
        <td><?= mb_strtoupper($dado->getArray()['descricao'],'utf8') ?></td>
        <td><?= mb_strtoupper($dado->getArray()['tipo'],'utf8') ?></td>
        <td><?= number_format($dado->getArray()['custo'],'2',',','.') ?></td>
        <td><?= number_format($dado->getArray()['preco'],'2',',','.') ?></td>
        <td><?= $dado->getArray()['qtdpromo'] ?> X <?= intval($dado->getArray()['vlrpromo']) ?></td>
    </tr>
        <?php 
            endforeach; 
            else: echo '*Nenhum Produto Cadastrado.';endif;
            ?>
    </tbody>
</table>
</div>
<?php endif; ?>
