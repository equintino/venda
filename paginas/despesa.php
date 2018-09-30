<style>
    h2{
        text-shadow: 1px 1px 1px gray;
    }
    th, td{
        text-align: center;
    }
</style>
<script>
    $(document).ready(function(){
        $(".dinheiro").mask("#.##0,00",{reverse: true}); 
    });
</script>
<?php
    $act = array_key_exists('act',$_GET)?$_GET['act']:null;
    if($act=="lista"):
        $dao = new Dao();
        $despesa = new Despesa();
        $search = new CriterioBusca();
        $search->setTabela("tb_despesa");
        $dados = $dao->encontre($search);        
?>
<div class="container mt-5">
    <h2>Despesas Extras</h2>
    <table class="table table-bordered table-hover table-striped table-responsive-sm" >
        <thead>
            <tr class="bg-primary" style="color:white">
                <th scope="col">TIPO</th>
                <th scope="col">VALOR</th>
                <th scope="col">FREQUÊNCIA</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                if(isset($dados)):
                    foreach($dados as $dado): 
                    ?>
            <tr>
                <td scope="row"><?=$dado->getArray()['tipo']?></td>
                <td align="right"><?= number_format($dado->getArray()['valor'],'2',',','.') ?></td>
                <td><?= frequencia($dado->getArray()['freq']) ?></td>
            </tr>
            <?php endforeach; endif;?>
        </tbody>
    </table>
    <?php elseif($act=='cad_desp'): ?>
    <div class="container mt-5">
    <h2>Cadastro de Despesas</h2>
    <div class="row">
        <div class="col-md-7">
    <form id="cad_desp" action="../paginas/add.php?origem=cad_desp" method="POST" class="form-horizontal">
        <div class="border border-secundary p-3 bg-light">
        <div class="form-group form-row">
            <div class="col-md">
            <label for="tipo" class="col-form-label">Tipo</label>
            <input type="text" class="form-control" id="tipo" name="tipo" placeholder="Digite o tipo da despesa" autofocus required/>
            </div><!-- col -->
        </div>
        <div class="form-group form-row">
            <div class="col-md-3">
            <label for="valor" class="col-form-label">Valor</label>
            <input type="text" class="form-control dinheiro" id="valor" name="valor" placeholder="Qual o valor?" />
            </div>
            <div class="col-md">
            <label for="freq" class="col-form-label">Freqûencia</label>
            <select name="freq" class="form-control">
                <option value=""></option>
                <option value="d">Diário</option>
                <option value="s">Semanal</option>
                <option value="m">Mensal</option>
                <option value="t">Trimestral</option>
            </select>
            </div><!-- col -->
        </div><!-- form row -->
        </div><!-- border -->
        <button class="btn btn-primary" style="float: right">Salvar</button>        
    </form>
        </div><!-- col 6 -->
        <div class="col-md">
            <img src="../web/image/despesa.png" alt="despesa" />
        </div>
    </div><!-- row -->
    </div>
    <?php endif; ?>
</div>
<?php
    function frequencia($fq){
        switch($fq){
            case 'd':
                $freq='DIÁRIO';
                break;
            case 's':
                $freq='SEMANAL';
                break;
            case 'm':
                $freq='MENSAL';
                break;
            case 't':
                $freq='TRIMESTRAL';
                break;
        }
        return $freq;
    }
?>