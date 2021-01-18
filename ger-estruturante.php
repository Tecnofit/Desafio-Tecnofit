<?php
	$ger_nome = "Estruturantes";
	$ger_slug = "estruturante";
	$ger_arquivo = "ger-estruturante.php";

	include_once("funcoes.php");

	logged();


	switch ($_GET['act']) {
		case 'Gravar':			
			$arrCampos['estrut_descricao'] = $_POST['estrut_descricao'];

			if ($_SESSION['db']->AutoExecute("estruturante",$arrCampos,"INSERT")) {
				$ger_msg = $ger_nome . " gravado com sucesso!";
				$ger_msg_tipo = 1;
				$_GET['act'] = null;
			} else {
				$ger_msg = "[1] Um erro ocorreu no cadastro de ". $ger_nome ;
				$ger_msg_tipo = 0;
				$_GET['act'] = "Inserir";
			}	
			break;
		case 'Atualizar':
			$arrCampos['estrut_descricao'] = $_POST['estrut_descricao'];

			if ($_SESSION['db']->AutoExecute("estruturante", $arrCampos, "UPDATE", "estrut_id = '".$_POST['estrut_id']."'")) {
				$ger_msg = $ger_nome . " alterado com sucesso!";
				$ger_msg_tipo = 1;
				$_GET['act'] = null;
			} else {
				$ger_msg = "[2] Um erro ocorreu no cadastro de ". $ger_nome ;
				$ger_msg_tipo = 0;
				$_GET['act'] = "Alterar";
				$_GET['cod'] = $_POST['estrut_id'];
			}
			break;
		case 'Excluir':
			$sql = "SELECT estrut_descricao FROM estruturante WHERE estrut_id = '".$_GET['cod']."'";
			$rs = $_SESSION['db']->GetRow($sql);			
			$sql = "DELETE FROM estruturante WHERE estrut_id = '".$_GET['cod']."'";
			if ($_SESSION['db']->Execute($sql,false)){
				$ger_msg = $ger_nome . " excluído com sucesso!";
				$ger_msg_tipo = 1;
			} else {
				$ger_msg = "[3] Um erro ocorreu no cadastro de ". $ger_nome;
				$ger_msg_tipo = 0;
			}
					$_GET['act'] = null;
			break;
	}

	include_once("cabecalho.php");
	include_once("migalhas.php");

?>

	<section id="<?=$ger_slug?>">
		<div class="row">
	        <div class="span3"><?php include_once("menu-lateral.php"); ?></div>
	        <div class="span9">
				<h3><?=$ger_nome?></h3>
				<script>
					$(document).ready(function(){
						$("#cadform").bind("submit",function(){
							var error_status = false;

							$("#grp_estrut_descricao").removeClass("error");							

							if ($("#estrut_descricao").val() == "") {
								$("#grp_estrut_descricao").addClass("error");
								$("#estrut_descricao").focus();
								error_status = true;
								return false;
							} else {
								return true;
							}
						});
						$(".botexcluir").bind("click",function(){
							popup_excluir("<?=$ger_arquivo?>",$(this).attr("rel"));
							return false;
						});
					});
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

					switch($_GET['act']) {
						case "Inserir":
				?>
							<form method="post" name="cadform" id="cadform" action="<?=$ger_arquivo?>?act=Gravar" class="well form-horizontal" enctype="multipart/form-data">
							<fieldset>
								<div class="control-group" id="grp_estrut_descricao">
									<label class="control-label">Descrição</label>									
                                    <div class="controls">
                                        <textarea class="input-xxlarge" name="estrut_descricao" rows="4" id="estrut_descricao"><?=$_POST['estrut_descricao']?></textarea>
                                    </div>
                                </div>								
								<div class="form-actions">
									<button class="btn btn-primary" type="submit">Inserir</button>
									<a href="<?=$ger_arquivo?>" class="btn">Voltar</a>
								</div>
							</fieldset>
							</form>
				<?php
							break;
						case "Alterar":
							$sql = "SELECT estrut_id, estrut_descricao FROM estruturante WHERE estrut_id = '".$_GET['cod']."'";
							$rs = $_SESSION['db']->GetRow($sql);
				?>
							<form method="post" name="cadform" id="cadform" action="<?=$ger_arquivo?>?act=Atualizar" class="well form-horizontal">
							<fieldset>
								<div class="control-group" id="grp_estrut_descricao">
                                    <label class="control-label">Descrição</label>
                                    <div class="controls">
                                        <textarea class="input-xxlarge" name="estrut_descricao" rows="4" id="estrut_descricao"><?=$rs['estrut_descricao']?></textarea>
                                    </div>
                                </div>
								<div class="form-actions">
									<input type="hidden" name="estrut_id" value="<?=$rs['estrut_id']?>">
									<button class="btn btn-primary" type="submit">Alterar</button>
									<a href="<?=$ger_arquivo?>" class="btn">Voltar</a>
								</div>
							</fieldset>
							</form>
				<?php
							break;
						default:
				?>
							<p><a href="<?=$ger_arquivo?>?act=Inserir" class="btn btn-primary" id="add_bot">Inserir</a></p>
							<table class="table table-striped table-bordered">
							  <thead>
							    <tr>
								<th>Descrição</th>
								<th colspan="2">Ações</th>
							    </tr>
							  </thead>
							  <tbody>
							  	<?php
							  	$sql = "SELECT estrut_id, estrut_descricao FROM estruturante";
							  	$rs = $_SESSION['db']->GetAll($sql);
							  	foreach ($rs as $key => $row) {
							  	?>
								    <tr>
										<td><?=$row['estrut_descricao']?></td>
										<td class="span1"><a href="<?=$ger_arquivo?>?act=Alterar&cod=<?=$row['estrut_id']?>"><i class="icon-edit"></i></a></td>
										<td class="span1"><a href="#" class="botexcluir" rel="<?=$row['estrut_id']?>"><i class="icon-trash"></i></a></td>
								    </tr>
								<?php
								}
								?>
							  </tbody>
							</table>
				<?php
							break;
					}
				?>

	    </div>
	</section>

<?php
	include_once("rodape.php");
?>
