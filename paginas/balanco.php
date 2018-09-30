<style>
    h2{
        text-align: center;
        text-shadow: 1px 1px 1px gray;
    }
    table th, table td{
        border: 1px solid gray;
    }
</style>
<script>
    $(document).ready(function(){
        $("#balanco").DataTable({
            stateSave: true,
            "language": {
                "lengthMenu": "Exibido _MENU_ linhas por páginas",
                "info": "Página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum dado disponível",
               	"sSearch":  "Busca",
                "zeroRecords": "Nenhum dado encontrado.",
                "oPaginate": {
                    "sFirst":    	"Primeira",
                    "sPrevious": 	"Anterior",
                    "sNext":     	"Proxima",
                    "sLast":     	"Última"
                },
            },
            "scrollX": true
        });
    });
</script>
<?php
    $produto = new Produto();
    $venda = new Venda();
    $dao = new Dao();
    $search = new CriterioBusca();
    
    $search->setTabela("tb_venda");
    $dados=$dao->encontre($search);
?>
<div class="container">
    <h2 class="mt-3">Balanço<img src="../web/image/blc.png" alt="balanco" height="30" style="margin-top:-15px"/></h2>
    <table id="balanco" class="display table-responsive-xl" >
        <thead>
            <tr>
                <th colspan="2" style="background: #65a7ff;color:white;text-shadow:1px 1px 1px black">PERÍODO</th>
            </tr>
            <tr>
                <th>DE</th>
                <th>ATÉ</th>
                <th>PRODUTO</th>
                <th>QTD</th>
                <th>VLR UNIT</th>
                <th>VLR PROMO</th>
                <th>RET MÍNIMO</th>
                <th>RET MÁXIMO</th>
            </tr>
        </thead>
        <tbody>
    <?php
        if(isset($dados)):
        foreach($dados as $dado):
            $idProd=$dado->getArray()['idprod'];
            $search->setTabela("tb_produto");
            $search->setArray(array('id'=>$idProd));
            $dados_prod=$dao->encontre($search);
            foreach($dados_prod as $dProd){
                $produto->setNome($dProd->getArray()['nome']);
                $produto->setDescricao($dProd->getArray()['descricao']);
                $produto->setTipo($dProd->getArray()['tipo']);
                $produto->setPreco($dProd->getArray()['preco']);
                $produto->setQtdPromo($dProd->getArray()['qtdpromo']);
                $produto->setVlrPromo($dProd->getArray()['vlrpromo']);
                $venda->setProduto($produto);
            }
            $venda->setPerDe($dado->getArray()['perde']);
            $venda->setPera($dado->getArray()['pera']);
            $venda->setQtd($dado->getArray()['qtd']);
            $venda->setIdProd($idProd);
            ?>
            <tr>
                <td align="center"><?= formData($venda->getPerDe()) ?></td>
                <td align="center"><?= formData($venda->getPerA()) ?></td>
                <td align="center"><?= mb_strtoupper($venda->getProduto()->getTipo(),'utf8') ?></td>
                <td align="center"><?= $venda->getQtd() ?></td>
                <td align="center"><?= number_format($venda->getProduto()->getPreco(),'2',',','.') ?></td>
                <td align="center"><?= number_format($venda->getProduto()->getVlrPromo() / $venda->getProduto()->getQtdPromo(),'2',',','.') ?></td>
                <td align="center"><?= number_format($venda->getQtd() * ($venda->getProduto()->getVlrPromo() / $venda->getProduto()->getQtdPromo()),'2',',','.') ?></td>
                <td align="center"><?= number_format($venda->getQtd() * $venda->getProduto()->getPreco(),'2',',','.') ?></td>
            </tr>
    <?php endforeach; endif; ?>
        </tbody>
        <tfoot>
            
        </tfoot>
    </table>
            
</div><!-- container -->
<?php
    function formData($dt){
        $data=preg_split('/-/',$dt);
        return $data[2].'/'.$data[1].'/'.$data[0];
    }
?>