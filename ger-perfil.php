<?php
	$ger_nome = "Perfil";
	$ger_slug = "perfil";
	$ger_arquivo = "ger-perfil.php";

	include_once("funcoes.php");

	logged();

	switch ($_GET['act']) {
		case 'Atualizar':
			$arrCampos['usuari_nome'] = $_POST['usuari_nome'];
			$arrCampos['usuari_email'] = $_POST['usuari_email'];
			if (!empty($_POST['usuari_senha']))
				$arrCampos['usuari_senha'] = md5($_POST['usuari_senha']);

			if ($_SESSION['db']->AutoExecute("usuario",$arrCampos,"UPDATE","usuari_id = '".$_POST['usuari_id']."'")) {
				$ger_msg = "Alterado com sucesso!";
				$ger_msg_tipo = 1;
				$_GET['act'] = null;
			} else {
				$ger_msg = "Um erro ocorreu.";
				$ger_msg_tipo = 0;
				$_GET['act'] = "Alterar";
				$_GET['cod'] = $_POST['usuari_id'];
			}
			break;
	}

	include_once("cabecalho.php");
	include_once("migalhas.php");

?>

	<section id="<?=$ger_slug?>">
		<div class="row">
	        <div class="span12">

				<h3><?=$ger_nome?></h3>

				<script>
					$(document).ready(function(){
						$("#cadform").bind("submit",function(){
							var error_status = false;

							$("#grp_usuari_nome").removeClass("error");
							$("#grp_usuari_email").removeClass("error");

							if ($("#usuari_nome").val() == "") {
								$("#grp_usuari_nome").addClass("error");
								$("#usuari_nome").focus();
								error_status = true;
								return false;
							} else if ($("#usuari_email").val() == "") {
								$("#grp_usuari_email").addClass("error");
								if (error_status == false) {
									$("#usuari_email").focus();
								}
								return false;
							} else {
								return true;
							}
						});
						$(".botexcluir").bind("click",function(){
							popup_excluir("<?=$ger_arquivo?>",$(this).attr("rel"));
							return false;
						});
					}); // FIM document.ready
				</script>

				<?php
					$ger_msg_class = array( 0 => "alert-error" , 1 => "alert-success" , 2 => "alert-info");
					if (!empty($ger_msg)) {
				?>
						<div class="alert alert-block <?=$ger_msg_class[$ger_msg_tipo]?>">
							<a class='close' data-dismiss='alert' href='#'>×</a><p class='alert-heading'><strong><?=$ger_msg?></strong></p>
						</div>
				<?php
					}

							$sql = "SELECT usuari_id, usuari_nome, usuari_email FROM usuario WHERE usuari_id = '".$_SESSION['l_cod']."'";
							$rs = $_SESSION['db']->GetRow($sql);
				?>
							<form method="post" name="cadform" id="cadform" action="<?=$ger_arquivo?>?act=Atualizar" class="well form-horizontal">
							<fieldset>
								<div class="control-group" id="grp_usuari_nome">
									<label class="control-label">Nome</label>
									<div class="controls">
										<input type="text" class="input-xlarge" name="usuari_nome" id="usuari_nome" value="<?=$rs['usuari_nome']?>" maxlength="255">
									</div>
								</div>
								<div class="control-group" id="grp_usuari_email">
									<label class="control-label">E-mail</label>
									<div class="controls">
										<input type="text" class="input-xlarge" name="usuari_email" id="usuari_email" value="<?=$rs['usuari_email']?>" maxlength="255">
									</div>
								</div>
								<div class="control-group" id="grp_usuari_senha">
									<label class="control-label">Nova Senha</label>
									<div class="controls">
										<input type="password" class="input-medium" name="usuari_senha" id="usuari_senha" maxlength="12">
									</div>
								</div>
								<div class="form-actions">
									<input type="hidden" name="usuari_id" value="<?=$rs['usuari_id']?>">
									<button class="btn btn-primary" type="submit">Salvar</button>
								</div>
							</fieldset>
							</form>

	    </div>
	</section>

<?php
	include_once("rodape.php");
?>
