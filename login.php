<?php
	include_once("funcoes.php");

	if ($_GET['act'] == "logout") {
		unset($_SESSION['l_cod']);
		unset($_SESSION['l_email']);
		unset($_SESSION['l_senha']);
		unset($_SESSION['l_nome']);
		unset($_SESSION['l_host']);
	}

	include_once("cabecalho.php");
?>

	<section id="home">
		<div class="row">
	        <span class="span4"></span>

	        <div class="span4">

                <br /><br /><br />
	        	<h3>Bem-vindo</h3>

	        	<div class="well">

	        		<div id="l_msg">
					</div>
					<form method="post" name="l_form" id="l_form" action="login.php">
						<div class="control-group" id="grp_l_email">
							<label>E-mail</label>
							<input type="text" class="span3" name="l_email" id="l_email" maxlength="200">
						</div>
						<div class="control-group" id="grp_l_senha">
							<label>Senha</label>
							<input type="password" class="span3" name="l_senha" id="l_senha" maxlength="15">
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-primary">Entrar</button>
						</div>
					</form>

	        	</div>
	        </div>
	        <div class="span4">
	        </div>
	    </div>
	</section>

<?php
	include_once("rodape.php");
?>

<script type="text/javascript">
login();
</script>