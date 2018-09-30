<!DOCTYPE html>
<html>
    <head>
        <title>Controle de Venda</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="web/css/bootstrap.css" type="text/css"/>
        <script src="web/js/jquery-3.3.1.min.js" type="text/javascript" ></script>
        <script src="web/js/bootstrap.js"></script>
        <style>
            body{
                background: #f4f4f4;
            }
            .container{
                margin-top: 10%;
                width: 330px;
            }
        </style>
        <?php
            $login = (isset($_COOKIE['CookieLogin'])) ? base64_decode($_COOKIE['CookieLogin']) : '';
            $senha = (isset($_COOKIE['CookieSenha'])) ? base64_decode($_COOKIE['CookieSenha']) : '';
            $lembrete = (isset($_COOKIE['CookieLembrete'])) ? base64_decode($_COOKIE['CookieLembrete']) : '';
            $checked = ($lembrete == 'SIM') ? 'checked' : '';
        ?>
    </head>
    <body class="text-center">
        <div class="container">
        <form class="form-signin mt-5" action="main.php" method="post" >
            <img class="mb-4" src="web/image/ass_e.png" alt="" height="62">
            <h1 class="h3 mb-3 font-weight-normal">Entre com o seu LOGIN</h1>
            <label for="login" class="sr-only">Login</label>
            <input type="text" id="login" name="login" class="form-control" placeholder="Digite seu login" required="" autofocus="" value="<?=$login?>">
            <label for="senha" class="sr-only">Senha</label>
            <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required value="<?=$senha?>">
            <div class="checkbox mb-3">
                <label><input type="checkbox" name="lembrete" value="SIM" <?=$checked?> > Lembre-me</label>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
            <p class="mt-5 mb-3 text-muted">© 2017-2018</p>
        </form>
        </div>
    </body>
</html>

<?php
 
/*$email = (isset($_COOKIE['CookieEmail'])) ? base64_decode($_COOKIE['CookieEmail']) : '';
$senha = (isset($_COOKIE['CookieSenha'])) ? base64_decode($_COOKIE['CookieSenha']) : '';
$lembrete = (isset($_COOKIE['CookieLembrete'])) ? base64_decode($_COOKIE['CookieLembrete']) : '';
$checked = ($lembrete == 'SIM') ? 'checked' : '';
 */
?>
<!--<!DOCTYPE html>
<html>
<head>
	<title>Login com Cookie</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<style type="text/css">
	fieldset{
		width: 300px;
		height: 250px;
		margin:10% auto;
	}
	</style>
</head>
<body>
	<fieldset>
		<legend><h1>Login</h1></legend>
		<form method="post" action="login.php">
			<div class="form-group">
		      <label for="email">E-mail</label>
		      <input type="text" class="form-control" value="<?=$email?>" id="email" name="email" placeholder="Infome o E-mail">
			</div>
			<div class="form-group">
		      <label for="senha">Senha</label>
		      <input type="password" class="form-control" value="<?=$senha?>" id="senha" name="senha" placeholder="Infome a Senha">
			</div>
			<div class="checkbox">
			    <label>
			      <input type="checkbox" name="lembrete" value="SIM" <?=$checked?>> Lembre-me
			    </label>
			</div>
		     <button type="submit" class="btn btn-primary" id='botao'> 
			   Entrar
		     </button>	
		</form>
	</fieldset>
</body>
</html>-->