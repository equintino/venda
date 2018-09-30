<style>
    nav.btn{
        color: white;
    } 
</style>
<?php
class topo {
    
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#"><img src="../web/image/ass_e.png" alt="logo" height="40" /></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="../web/index.php?pagina=home" >Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false" >Produtos</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a href="../web/index.php?pagina=cadastro&act=lista" class="dropdown-item" >Lista de Produtos</a>
            <a href="../web/index.php?pagina=cadastro&act=cad_prod" class="dropdown-item" >Cadastro de Produtos</a>
        </div>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="../web/index.php?pagina=venda" >Vendas</a>
      </li>
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" id="despesasDropdown" role="button" arial-expanded="false">Despesas</a>
        <div class="dropdown-menu" aria-labelledby="despesasDropdown">
            <a href="../web/index.php?pagina=despesa&act=lista"  class="dropdown-item" >Detalhes Despesas</a>
            <a href="../web/index.php?pagina=despesa&act=cad_desp" class="dropdown-item" >Cadastro de Despesas</a>
        </div>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="../web/index.php?pagina=balanco" >Balanço</a>
      </li>
      <!--<li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>-->
    </ul>
    <!--<form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="O que voçê procura?" aria-label="Search">
      <button class="btn btn-outline-light my-2 my-sm-0" type="submit" >Busca</button>
    </form>-->
    <div class="navbar navbar-right">
        <a class="nav-link" href="../web/index.php?pagina=cadastro&act=cad_pessoa" style="color:white">Cadastro de Login</a>
        <a class="nav-link" href="../web/sair.php" style="color:white">Sair</a>
    </div><!-- navbar rigth-->
  </div>
</nav>