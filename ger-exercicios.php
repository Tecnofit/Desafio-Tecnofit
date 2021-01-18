<?php
	$ger_nome = "Exercício";
	$ger_slug = "exercicios";
	$ger_arquivo = "ger-exercicios.php";

	include_once("funcoes.php");

	logged();

	switch ($_GET['act']) {
		case 'Gravar':
			$arrCampos['exerci_descricao'] = $_POST['exerci_descricao'];

			if ($_SESSION['db']->AutoExecute("exercicios",$arrCampos,"INSERT")) {
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
			$arrCampos['exerci_descricao'] = $_POST['exerci_descricao'];
			
			if ($_SESSION['db']->AutoExecute("exercicios", $arrCampos, "UPDATE", "exerci_id = '".$_POST['exerci_id']."'")) {
				$ger_msg = $ger_nome . " alterado(a) com sucesso!";
				$ger_msg_tipo = 1;
				$_GET['act'] = null;
			} else {
				$ger_msg = "[2] Um erro ocorreu no cadastro de ". $ger_nome ;
				$ger_msg_tipo = 0;
				$_GET['act'] = "Alterar";
				$_GET['cod'] = $_POST['area_id'];
			}
			break;
		case 'Excluir':

            $sqlTotal = "
            SELECT count(1) as total FROM treino_exercicio
            INNER JOIN exercicios on exercicios.exerci_id = treino_exercicio_exerci_id
            INNER JOIN treino_usuario on treino_usuario.treino_usuario_id = treino_exercicio_treino_usuario_id
            WHERE treino_exercicio.treino_exercicio_exerci_id = '".$_GET['cod']."' and treino_usuario_status = 'Ativo'";

            $rsCount = $_SESSION['db']->GetRow($sqlTotal);

            if ($rsCount['total'] == 0) {

                $sql = "SELECT exerci_descricao FROM exercicios WHERE exerci_id = '" . $_GET['cod'] . "'";
                $rs = $_SESSION['db']->GetRow($sql);
                $sql = "DELETE FROM exercicios WHERE exerci_id = '" . $_GET['cod'] . "'";
                if ($_SESSION['db']->Execute($sql, false)) {
                    $ger_msg = $ger_nome . " excluído com sucesso!";
                    $ger_msg_tipo = 1;
                } else {
                    $ger_msg = "[3] Um erro ocorreu no cadastro de " . $ger_nome;
                    $ger_msg_tipo = 0;
                }
                $_GET['act'] = null;
            } else {
                $ger_msg = "[4] Existe vinculo com o exercicio ativo " . $ger_nome;
                $ger_msg_tipo = 0;
                $_GET['act'] = null;
            }
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

							$("#grp_area_descricao").removeClass("error");							

							if ($("#area_descricao").val() == "") {
								$("#grp_area_descricao").addClass("error");
								$("#area_descricao").focus();
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
								<div class="control-group" id="grp_exerci_descricao">
									<label class="control-label">Nome do Exercício</label>
                                    <div class="controls">
                                        <textarea class="input-xxlarge" name="exerci_descricao" rows="4" id="exerci_descricao"><?=$_POST['exerci_descricao']?></textarea>
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
							$sql = "SELECT exerci_id, exerci_descricao FROM exercicios WHERE exerci_id = '".$_GET['cod']."'";
							$rs = $_SESSION['db']->GetRow($sql);
				?>
							<form method="post" name="cadform" id="cadform" action="<?=$ger_arquivo?>?act=Atualizar" class="well form-horizontal">
							<fieldset>
								<div class="control-group" id="grp_exerci_descricao">
                                    <label class="control-label">Descrição</label>
                                    <div class="controls">
                                        <textarea class="input-xxlarge" name="exerci_descricao" rows="4" id="exerci_descricao"><?=$rs['exerci_descricao']?></textarea>
                                    </div>
                                </div>
								<div class="form-actions">
									<input type="hidden" name="exerci_id" value="<?=$rs['exerci_id']?>">
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
							  	$sql = "SELECT exerci_id, exerci_descricao FROM exercicios order by exerci_id DESC ";
							  	$rs = $_SESSION['db']->GetAll($sql);
							  	foreach ($rs as $key => $row) {
							  	?>
								    <tr>
										<td><?=$row['exerci_descricao']?></td>
										<td class="span1"><a href="<?=$ger_arquivo?>?act=Alterar&cod=<?=$row['exerci_id']?>"><i class="icon-edit"></i></a></td>
										<td class="span1"><a href="#" class="botexcluir" rel="<?=$row['exerci_id']?>"><i class="icon-trash"></i></a></td>
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