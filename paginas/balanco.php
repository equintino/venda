<style>
    @media(min-width:700px){
        .balanco{
            width: 1000px;
            margin: auto;
        }
    }
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
        $("tr").keyup(function(){
            var qtd=$(this).find("td[nome=qtd]").text();
            var sobra=$(this).find("input.sobra").val();
            var vendido=qtd-sobra;
            
            var custo=$(this).find("td[nome=custo]").text();
            var preco=$(this).find("td[nome=preco]").text();
            var vlrPromo=$(this).find("td[nome=vlrPromo]").text();
            
            var retMin=vendido * (vlrNum(vlrPromo) - vlrNum(custo));
            var retMax=vendido * (vlrNum(preco) - vlrNum(custo));
            
            $(this).find("td[nome=lqMin]").text(moeda(retMin));
            $(this).find("td[nome=lqMax]").text(moeda(retMax));
            
        });
    });
    function vlrNum(vlr){
        return vlr.replace('.','').replace(',','.');
    }
    function moeda(vlr){
        return vlr.toFixed(2).replace('.',',');
    }
</script>
<?php
    $dao = new Dao();
    $search = new CriterioBusca();
    
    $search->setTabela("tb_venda");
    $dados=$dao->encontre($search);
?>
<div class="balanco">
    <form action="#" method="POST" ><!--../paginas/add.php?origem=venda_sobra-->
    <h2 class="mt-3">Balanço<img src="../web/image/blc.png" alt="balanco" height="30" style="margin-top:-15px"/></h2>
    <!--<div style="float:right"><button class="btn-sm btn-primary" style="text-shadow: 1px 1px 1px black;position: relative;top: -30px">SALVAR</button></div>-->
    <table id="balanco" class="display table-responsive-xl" >
        <thead>
            <tr>
                <th colspan="2" style="background: #65a7ff;color:white;text-shadow:1px 1px 1px black;text-align:center">PERÍODO</th>
                <th colspan="6"></th>
                <th colspan="2" style="background: #65a7ff;color:white;text-shadow:1px 1px 1px black;text-align:center">LÍQUIDO</th>
            </tr>
            <tr style="text-align: center">
                <th>DE</th>
                <th>ATÉ</th>
                <th>PRODUTO</th>
                <th>QTD</th>
                <th>CUSTO</th>
                <th>VLR UNIT</th>
                <th>VLR PROMO</th>
                <th>SOBRA</th>
                <th>LÍQUIDO MÍNIMO</th>
                <th>LÍQUIDO MÁXIMO</th>
            </tr>
        </thead>
        <tbody>
    <?php
        if(isset($dados)):
            $chaves=array_keys($dados);
            foreach($chaves as $key){
                $idsProd[]=$dados[$key]->getArray()['idprod'];
            }
            $idsProd=array_diff(array_count_values($idsProd),array(1));/* Produtos repetidos para somatório */
            $i=0;
        foreach($dados as $dado):
            $idProd=$dado->getArray()['idprod'];/* id do Produto */
            $search->setTabela("tb_produto");
            $search->setArray(array('id'=>$idProd));
            $dados_prod=$dao->encontre($search);/* dados do produto */
            foreach($dados_prod as $dProd){
                $venda = new Venda();
                $produto = new Produto();
                if(array_key_exists($idProd,$idsProd)){/* produto que possui mais de uma entrada */
                    $x=$dProd->getArray()['tipo'];/* variável para soma de repetição $x=tipo produto*/
                    if(!isset($$x)){/* atribua valor só se $xx não existir */
                        $$x=$idsProd[$idProd];/* $$x=quantidade de $x */
                        $qtd=$dado->getArray()['qtd'];
                        
                        
                        $produto->setNome($dProd->getArray()['nome']);
                        $produto->setDescricao($dProd->getArray()['descricao']);
                        $produto->setTipo($dProd->getArray()['tipo']);
                        $produto->setPreco($dProd->getArray()['preco']);
                        $produto->setQtdPromo($dProd->getArray()['qtdpromo']);
                        $produto->setVlrPromo($dProd->getArray()['vlrpromo']);
                        $produto->setCusto($dProd->getArray()['custo']);
                        $venda->setProduto($produto);

                        $venda->setPerDe($dado->getArray()['perde']);
                        $venda->setPera($dado->getArray()['pera']);
                        $venda->setQtd($dado->getArray()['qtd']);
                        $venda->setIdProd($idProd);/* identificação exclusiva do produto(tipo) */ 
                        
                        $V[$venda->getProduto()->getTipo()]=$venda;
                        
                    }else{/*quantidade de produto em transito para ser somada*/
                        $V[$dProd->getArray()['tipo']]->setPerDe($dado->getArray()['perde']);
                        $V[$dProd->getArray()['tipo']]->setPerA($dado->getArray()['pera']);
                        $V[$dProd->getArray()['tipo']]->somaQtd($dado->getArray()['qtd']);
                    }
                    $ok=null;
                }else{
                    $ok=1;
                    $produto->setNome($dProd->getArray()['nome']);
                    $produto->setDescricao($dProd->getArray()['descricao']);
                    $produto->setTipo($dProd->getArray()['tipo']);
                    $produto->setPreco($dProd->getArray()['preco']);
                    $produto->setQtdPromo($dProd->getArray()['qtdpromo']);
                    $produto->setVlrPromo($dProd->getArray()['vlrpromo']);
                    $produto->setCusto($dProd->getArray()['custo']);
                    $venda->setProduto($produto);

                    $venda->setPerDe($dado->getArray()['perde']);
                    $venda->setPera($dado->getArray()['pera']);
                    $venda->setQtd($dado->getArray()['qtd']);
                    $venda->setIdProd($idProd);/* identificação exclusiva do produto(tipo) */   
                }           
            }
            if(isset($ok)){
                $V[$venda->getProduto()->getTipo()]=$venda;
            }
            endforeach;
            ?>
            <?php foreach($V as $venda): ?>
            <tr>
                <td align="center"><?= formData($venda->getPerDe()) ?></td>
                <td align="center"><?= formData($venda->getPerA()) ?></td>
                <td align="center"><?= mb_strtoupper($venda->getProduto()->getNome(),'utf8').'('.mb_strtoupper($venda->getProduto()->getTipo(),'utf8').')' ?></td>
                <td align="center" nome="qtd"><?= $venda->getQtd() ?></td>
                <td align="center" nome="custo" style="color:red"><?= number_format($venda->getProduto()->getCusto(),'2',',','.') ?></td>
                <td align="center" nome="preco"><?= number_format($venda->getProduto()->getPreco(),'2',',','.') ?></td>
                <td align="center" nome="vlrPromo"><?= number_format($venda->getProduto()->getVlrPromo() / $venda->getProduto()->getQtdPromo(),'2',',','.') ?></td>
                <td align="center"><input class="sobra" type="text" name="<?= $venda->getProduto()->getTipo() ?>" maxlength="3" size="2" required/></td>
                <td align="center" nome="lqMin"><?= number_format($venda->getQtd() * (($venda->getProduto()->getVlrPromo() / $venda->getProduto()->getQtdPromo()) - $venda->getProduto()->getCusto()),'2',',','.') ?></td>
                <td align="center" nome="lqMax"><?= number_format($venda->getQtd() * ($venda->getProduto()->getPreco() - $venda->getProduto()->getCusto()),'2',',','.') ?></td>
            </tr>
    <?php endforeach; endif; ?>
        </tbody>
        <tfoot>
            
        </tfoot>
    </table>
    </form>   
</div><!-- container -->
<?php
    function formData($dt){
        $data=preg_split('/-/',$dt);
        return $data[2].'/'.$data[1].'/'.$data[0];
    }
?>