<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="../web/image/ass_e.ico" />
        <link rel="stylesheet" href="../web/css/bootstrap.css">
        <link rel="stylesheet" href="../web/css/dataTables.min.css" />
        <script src="../web/js/jquery-3.3.1.min.js" type="text/javascript" ></script>
        <script src="../web/js/bootstrap.js"></script>
        <script src="../web/js/jquery.mask.min.js"></script>
        <script src="../web/js/funcao.js"></script>
        <script src="../web/js/datatables.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Controle de Venda</title>
        <?php $pagina=array_key_exists("pagina",$_GET)?$_GET['pagina']:"home"; ?>
    </head>
    <body>
        <?php require_once "../layout/topo.php"; ?>
        <div class="content">
            <?php require_once "../paginas/".$pagina.".php"; ?>
            <!--<div class="tab-content">
                <div id="home" class="tab-pane active" >
                    <?php //require_once "../paginas/home.php"; ?>
                    pagina home
                </div>
                <div id="cadastro" class="tab-pane" >
                    <?php //require_once "../paginas/cadastro.php"; ?>
                    pagina cadastro
                </div>
                <div id="venda" class="tab-pane" >
                    <?php //require_once "../paginas/venda.php"; ?>
                    pagina venda
                </div>
                <div id="despesa" class="tab-pane" >
                    <?php //require_once "../paginas/despesa.php"; ?>
                    pagina despesa
                </div>
                <div id="balanco" class="tab-pane" >
                    <?php //require_once "../paginas/balanco.php"; ?>
                    pagina balanço
                </div>
            </div><!-- tab content -->
        </div><!-- content -->
        
        
        <?php require_once "../layout/footer.php"; ?>
    </body>
</html>
