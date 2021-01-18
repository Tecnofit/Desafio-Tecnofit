<?php	

	$ger_nome = "Alunos / Usuários";
	$ger_slug = "usuarios";
	$ger_arquivo = "ger-usuarios.php";

	include_once("funcoes.php");
	logged();	

	switch ($_GET['act']) {
		case 'Gravar':
			$arrCampos['usuari_nome'] = $_POST['usuari_nome'];
			$arrCampos['usuari_email'] = $_POST['usuari_email'];
			$arrCampos['usuari_senha'] = md5($_POST['usuari_senha']);
			$arrCampos['usuari_tipo'] = 'usuario';
            $arrCampos['usuari_status'] = 1;

            $arrCampos['usuari_matricula'] = $_POST['usuari_matricula'];
            $arrCampos['usuari_dt_nascimento'] =  implode("-",array_reverse(explode("/",$_POST['usuari_dt_nascimento'])));
            $arrCampos['usuari_peso'] = floatval($_POST['usuari_peso']);
            $arrCampos['usuari_altura'] = floatval($_POST['usuari_altura']);
            $arrCampos['usuari_endereco'] = $_POST['usuari_endereco'];
            $arrCampos['usuari_objetivo'] = $_POST['usuari_objetivo'];
            $arrCampos['usuari_observacoes'] = $_POST['usuari_observacoes'];
            $arrCampos['usuari_tipo_documento'] = $_POST['usuari_tipo_documento'];
            $arrCampos['usuari_documento'] = $_POST['usuari_documento'];
            $arrCampos['usuari_celular'] = $_POST['usuari_celular'];
            $arrCampos['usuari_turno'] = $_POST['usuari_turno'];

			if ($_SESSION['db']->AutoExecute("usuario",$arrCampos,"INSERT")) {
				$ger_msg = "Gravado com sucesso!";
				$ger_msg_tipo = 1;
				$_GET['act'] = null;
			} else {
				$ger_msg = "Um erro ocorreu.";
				$ger_msg_tipo = 0;
				$_GET['act'] = "Inserir";
			}
			break;
		case 'Atualizar':
			$arrCampos['usuari_nome'] = $_POST['usuari_nome'];
			$arrCampos['usuari_email'] = $_POST['usuari_email'];
			$arrCampos['usuari_status'] = $_POST['usuari_status'];
            $arrCampos['usuari_matricula'] = $_POST['usuari_matricula'];
            $arrCampos['usuari_dt_nascimento'] =  implode("-",array_reverse(explode("/",$_POST['usuari_dt_nascimento'])));;
            $arrCampos['usuari_peso'] = $_POST['usuari_peso'];
            $arrCampos['usuari_altura'] = $_POST['usuari_altura'];
            $arrCampos['usuari_endereco'] = $_POST['usuari_endereco'];
            $arrCampos['usuari_objetivo'] = $_POST['usuari_objetivo'];
            $arrCampos['usuari_observacoes'] = $_POST['usuari_observacoes'];
            $arrCampos['usuari_tipo_documento'] = $_POST['usuari_tipo_documento'];
            $arrCampos['usuari_documento'] = $_POST['usuari_documento'];
            $arrCampos['usuari_celular'] = $_POST['usuari_celular'];
            $arrCampos['usuari_turno'] = $_POST['usuari_turno'];

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
		case 'Excluir':
			$sql = "DELETE FROM usuario WHERE usuari_id = '".$_GET['cod']."'";
			if ($_SESSION['db']->Execute($sql,false)){
				$ger_msg = "Excluído com sucesso!";
				$ger_msg_tipo = 1;
			} else {
				$ger_msg = "Um erro ocorreu.";
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
	        <div class="span3">
	        	<?php
	        		include_once("menu-lateral.php");
	        	?>
	        </div><!--/span-->

	        <div class="span9">

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

					switch($_GET['act']) {
						case "Inserir":
				?>
							<form method="post" name="cadform" id="cadform" action="<?=$ger_arquivo?>?act=Gravar" class="well form-horizontal">
							<fieldset>
								<div class="control-group" id="grp_usuari_nome">
									<label class="control-label">Nome</label>
									<div class="controls">
										<input type="text" class="input-xlarge" name="usuari_nome" id="usuari_nome" value="<?=$_POST['usuari_nome']?>" maxlength="255">
									</div>
								</div>
                                <div class="control-group" id="grp_usuari_matricula">
                                    <label class="control-label">Matricula</label>
                                    <div class="controls">
                                        <input type="text" class="input-xlarge" name="usuari_matricula" id="usuari_matricula" value="<?=$_POST['usuari_matricula']?>" maxlength="255">
                                    </div>
                                </div>
                                <div class="control-group" id="grp_usuari_tipo_documento">
                                    <label class="control-label">Tipo Documento</label>
                                    <div class="controls">
                                        <select class="input-medium" name="usuari_tipo_documento" id="usuari_tipo_documento">
                                            <option value='CPF' <?=($_POST['usuari_tipo_documento'] == 'CPF')?"selected":""?>>CPF</option>
                                            <option value='RG' <?=($_POST['usuari_tipo_documento'] == 'RG')?"selected":""?>>RG</option>
                                            <option value='Motorista' <?=($_POST['usuari_tipo_documento'] == 'Motorista')?"selected":""?>>Motorista</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group" id="grp_usuari_documento">
                                    <label class="control-label">Documento</label>
                                    <div class="controls">
                                        <input type="text" class="input-xlarge" name="usuari_documento" id="usuari_documento" value="<?=$_POST['usuari_documento']?>" maxlength="15">
                                    </div>
                                </div>
                                <div class="control-group" id="grp_usuari_celular">
                                    <label class="control-label">Celular</label>
                                    <div class="controls">
                                        <input type="text" class="input-xlarge" name="usuari_celular" id="usuari_celular" value="<?=$_POST['usuari_celular']?>" maxlength="15">
                                    </div>
                                </div>
                                <div class="control-group" id="grp_usuari_dt_nascimento">
                                    <label class="control-label">Data de nascimento</label>
                                    <div class="controls">
                                        <div class="input-append date" id="dp5" data-date="<?=date("d/m/Y")?>" data-date-format="dd/mm/yyyy">
                                            <input class="input-small" value="<?=implode("/",array_reverse(explode("-",$_POST['usuari_dt_nascimento'])))?>" id="usuari_dt_nascimento" name="usuari_dt_nascimento" type="text">
                                            <span class="add-on"><i class="icon-th"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group" id="grp_usuari_peso">
                                    <label class="control-label">Peso</label>
                                    <div class="controls">
                                        <input type="text" class="input-xlarge" name="usuari_peso" id="usuari_peso" value="<?=$_POST['usuari_peso']?>" maxlength="10">
                                    </div>
                                </div>
                                <div class="control-group" id="grp_usuari_altura">
                                    <label class="control-label">Altura</label>
                                    <div class="controls">
                                        <input type="text" class="input-xlarge" name="usuari_altura" id="usuari_altura" value="<?=$_POST['usuari_altura']?>" maxlength="10">
                                    </div>
                                </div>
                                <div class="control-group" id="grp_usuari_endereco">
                                    <label class="control-label">Endereço</label>
                                    <div class="controls">
                                        <input type="text" class="input-xxlarge" name="usuari_endereco" id="usuari_endereco" value="<?=$_POST['usuari_endereco']?>" maxlength="255">
                                    </div>
                                </div>
                                <div class="control-group" id="grp_usuari_objetivo">
                                    <label class="control-label">Objetivo</label>
                                    <div class="controls">
                                        <select class="input-medium" name="usuari_objetivo" id="usuari_objetivo">
                                            <option value='Emagrecer' <?=($_POST['usuari_objetivo'] == 'Emagrecer')?"selected":""?>>Emagrecer</option>
                                            <option value='Definição Muscular' <?=($_POST['usuari_objetivo'] == 'Definição Muscular')?"selected":""?>>Definição Muscular</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group" id="grp_usuari_turno">
                                    <label class="control-label">Turno</label>
                                    <div class="controls">
                                        <select class="input-medium" name="usuari_turno" id="usuari_turno">
                                            <option value='Manhã' <?=($_POST['usuari_turno'] == 'Manhã')?"selected":""?>>Manhã</option>
                                            <option value='Tarde' <?=($_POST['usuari_turno'] == 'Tarde')?"selected":""?>>Tarde</option>
                                            <option value='Noite' <?=($_POST['usuari_turno'] == 'Noite')?"selected":""?>>Noite</option>
                                            <option value='Outros' <?=($_POST['usuari_turno'] == 'Outros')?"selected":""?>>Outros</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group" id="grp_usuari_observacoes">
                                    <label class="control-label">Observações</label>
                                    <div class="controls">
                                        <textarea class="input-xlarge" name="usuari_observacoes" id="usuari_observacoes" rows="5"><?=$_POST['usuari_observacoes']?></textarea>
                                    </div>
                                </div>
								<div class="control-group" id="grp_usuari_email">
									<label class="control-label">E-mail</label>
									<div class="controls">
										<input type="text" class="input-xlarge" name="usuari_email" id="usuari_email" value="<?=$_POST['usuari_email']?>" maxlength="255">
									</div>
								</div>
								<div class="control-group" id="grp_usuari_senha">
									<label class="control-label">Senha</label>
									<div class="controls">
										<input type="password" class="input-medium" name="usuari_senha" id="usuari_senha" value="<?=$_POST['usuari_senha']?>" maxlength="12">
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
							$sql = "SELECT usuari_id, usuari_nome, usuari_status, usuari_email, usuari_senha, usuari_tipo, usuari_matricula, usuari_dt_nascimento, usuari_peso, usuari_altura, usuari_endereco, usuari_objetivo, usuari_observacoes, usuari_tipo_documento, usuari_documento, usuari_celular, usuari_dt_cadastro, usuari_turno FROM usuario WHERE usuari_id = '".$_GET['cod']."'";
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
                                <div class="control-group" id="grp_usuari_matricula">
                                    <label class="control-label">Matricula</label>
                                    <div class="controls">
                                        <input type="text" class="input-xlarge" name="usuari_matricula" id="usuari_matricula" value="<?=$rs['usuari_matricula']?>" maxlength="255">
                                    </div>
                                </div>
                                <div class="control-group" id="grp_usuari_tipo_documento">
                                    <label class="control-label">Tipo Documento</label>
                                    <div class="controls">
                                        <select class="input-medium" name="usuari_tipo_documento" id="usuari_tipo_documento">
                                            <option value='CPF' <?=($rs['usuari_tipo_documento'] == 'CPF')?"selected":""?>>CPF</option>
                                            <option value='RG' <?=($rs['usuari_tipo_documento'] == 'RG')?"selected":""?>>RG</option>
                                            <option value='Motorista' <?=($rs['usuari_tipo_documento'] == 'Motorista')?"selected":""?>>Motorista</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group" id="grp_usuari_documento">
                                    <label class="control-label">Documento</label>
                                    <div class="controls">
                                        <input type="text" class="input-xlarge" name="usuari_documento" id="usuari_documento" value="<?=$rs['usuari_documento']?>" maxlength="15">
                                    </div>
                                </div>
                                <div class="control-group" id="grp_usuari_celular">
                                    <label class="control-label">Celular</label>
                                    <div class="controls">
                                        <input type="text" class="input-xlarge" name="usuari_celular" id="usuari_celular" value="<?=$rs['usuari_celular']?>" maxlength="15">
                                    </div>
                                </div>
                                <div class="control-group" id="grp_usuari_dt_nascimento">
                                    <label class="control-label">Data de nascimento</label>
                                    <div class="controls">
                                        <div class="input-append date" id="dp5" data-date="<?=date("d/m/Y")?>" data-date-format="dd/mm/yyyy">
                                            <input class="input-small" value="<?=implode("/",array_reverse(explode("-",$rs['usuari_dt_nascimento'])))?>" id="usuari_dt_nascimento" name="usuari_dt_nascimento" type="text">
                                            <span class="add-on"><i class="icon-th"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group" id="grp_usuari_peso">
                                    <label class="control-label">Peso</label>
                                    <div class="controls">
                                        <input type="text" class="input-xlarge" name="usuari_peso" id="usuari_peso" value="<?=$rs['usuari_peso']?>" maxlength="10">
                                    </div>
                                </div>
                                <div class="control-group" id="grp_usuari_altura">
                                    <label class="control-label">Altura</label>
                                    <div class="controls">
                                        <input type="text" class="input-xlarge" name="usuari_altura" id="usuari_altura" value="<?=$rs['usuari_altura']?>" maxlength="10">
                                    </div>
                                </div>
                                <div class="control-group" id="grp_usuari_endereco">
                                    <label class="control-label">Endereço</label>
                                    <div class="controls">
                                        <input type="text" class="input-xxlarge" name="usuari_endereco" id="usuari_endereco" value="<?=$rs['usuari_endereco']?>" maxlength="255">
                                    </div>
                                </div>
                                <div class="control-group" id="grp_usuari_objetivo">
                                    <label class="control-label">Objetivo</label>
                                    <div class="controls">
                                        <select class="input-medium" name="usuari_objetivo" id="usuari_objetivo">
                                            <option value='Emagrecer' <?=($rs['usuari_objetivo'] == 'Emagrecer')?"selected":""?>>Emagrecer</option>
                                            <option value='Definição Muscular' <?=($rs['usuari_objetivo'] == 'Definição Muscular')?"selected":""?>>Definição Muscular</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group" id="grp_usuari_turno">
                                    <label class="control-label">Turno</label>
                                    <div class="controls">
                                        <select class="input-medium" name="usuari_turno" id="usuari_turno">
                                            <option value='Manhã' <?=($rs['usuari_turno'] == 'Manhã')?"selected":""?>>Manhã</option>
                                            <option value='Tarde' <?=($rs['usuari_turno'] == 'Tarde')?"selected":""?>>Tarde</option>
                                            <option value='Noite' <?=($rs['usuari_turno'] == 'Noite')?"selected":""?>>Noite</option>
                                            <option value='Outros' <?=($rs['usuari_turno'] == 'Outros')?"selected":""?>>Outros</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group" id="grp_usuari_observacoes">
                                    <label class="control-label">Observações</label>
                                    <div class="controls">
                                        <textarea class="input-xlarge" name="usuari_observacoes" id="usuari_observacoes" rows="5"><?=$rs['usuari_observacoes']?></textarea>
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
								<th>Nome</th>
								<th>E-mail</th>
								<th colspan="2"></th>
							    </tr>
							  </thead>
							  <tbody>
							  	<?php
							  	$sql = "SELECT usuari_id, usuari_nome, usuari_email FROM usuario WHERE usuari_email <> '' ";
							  	if($_SESSION['l_tipo'] == 'usuario') {
                                    $sql .= "AND usuari_id = " . $_SESSION["l_cod"];
                                }
							  	$rs = $_SESSION['db']->GetAll($sql);
							  	foreach ($rs as $key => $row) {
							  	?>
								    <tr>
										<td><?=$row['usuari_nome']?></td>
										<td><?=$row['usuari_email']?></td>
										<td class="span1"><a href="<?=$ger_arquivo?>?act=Alterar&cod=<?=$row['usuari_id']?>"><i class="icon-edit"></i></a></td>
										<td class="span1"><a href="#" class="botexcluir" rel="<?=$row['usuari_id']?>"><i class="icon-trash"></i></a></td>
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