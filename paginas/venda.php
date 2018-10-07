<style>
    h2{
        text-shadow: 1px 1px 1px gray;
    }
</style>
<script>
    $(document).ready(function(){
        $("table tr").keyup(function(){
            var emTrans = parseInt($(this).find("td input[type=number]").val());
            var preco = $(this).find("td input").attr("preco");
            var promo = $(this).find("td input").attr("promo");
            var vlrpromo = parseInt($(this).find("td input").attr("vlrpromo"));
            var min = addCommas(((emTrans * vlrpromo)/promo).toFixed(2));
            var max = addCommas((emTrans * preco).toFixed(2));
            $(this).find("td[nome=retMin]").text(min);
            $(this).find("td[nome=retMax]").text(max);
        });
        $("input[type=date]").change(function(){
            var perDe = $("input[name=periodoDe]").val();
            var perA = $("input[name=periodoA]").val();
            var ok = perDe <= perA;
            if(!ok && perA){
                alert("Período incopatível");
                exit;
            }
        });
    });
</script>
<?php
    $dao = new Dao();
    $search = new CriterioBusca();
    $model = new Model();
    $produto = new Produto();
    $venda = new Venda();
    
    $model->setTabela("tb_venda");
    $model->setArray($venda);
        
    $search->setTabela("tb_produto");
    $ltProd = $dao->encontre($search);
    
?>
<div class="container mt-5">
    <form action="../paginas/add.php?origem=cad_venda" method="post" >
    <h2>Controle de Vendas</h2>
    <label>Período:</label>
    <input type="date" name="periodoDe" required/>
    <input type="date" name="periodoA" required/>
<table class='table table-bordered table-hover table-striped table-responsive-sm'>
    <thead class='bg-primary' style='color:white;text-shadow: 1px 1px 1px gray'>
    <tr>
        <th scope="col">PRODUTO</th>
        <th scope="col">EM TRANSITO</th>
        <th scope="col">RETORNO MÍNIMO</th>
        <th scope="col">RETORNO MÁXIMO</th>
    </tr>
    </thead>
    <tbody>
        <?php 
            if(isset($ltProd)):
                foreach($ltProd as $lista): 
                ?>
    <tr>
        <td scope='row'><?= mb_strtoupper($lista->getArray()['nome'],'utf8')." (".mb_strtoupper($lista->getArray()['tipo'],'utf8').") " ?>
        </td>
        <td><input type="number" name="<?= $lista->getArray()['tipo'] ?>" preco="<?= $lista->getArray()['preco'] ?>" vlrpromo="<?= $lista->getArray()['vlrpromo'] ?>" promo="<?= $lista->getArray()['qtdpromo'] ?>"/></td>
        <td nome="retMin" align="right"></td>
        <td nome="retMax" align="right"></td>
    </tr>
        <?php endforeach; endif;?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4">
    <button class="btn bg-primary" style="color: white;font-weight: bolder;text-shadow: 1px 1px 1px gray;float: right">Salvar</button>
            </td>
        </tr>
    </tfoot>
</table>
    </form>
</div>