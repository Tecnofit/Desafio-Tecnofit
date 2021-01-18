<?php	

	$ger_nome = "Projetos";
	$ger_slug = "projetos";
	$ger_arquivo = "ger-projetos.php";

	include_once("funcoes.php");

	$ger_folder = BASE_PATH."/repositorio/projetos";
	$ger_folder_url = "repositorio/projetos";

	logged();

	/* verifica qual o acesso aos projetos pelo e-mail do usuário */


	$arrpilares = array (
		1 => 'pilare_personalidade',
		2 => 'pilare_conexao',
		3 => 'pilare_gestao',
		4 => 'pilare_servico',
		5 => 'pilare_inovacao'
	);

	switch ($_GET['act']) {
		case 'Gravar':
			if($_SESSION["l_tipo"] == "administrador") {
				$arrCampos['projet_estruturante_id'] = $_POST['projet_estruturante_id'];
				$arrCampos['projet_pai_id'] = $_POST['projet_pai_id'];
				$arrCampos['projet_titulo'] = $_POST['projet_titulo'];
				$arrCampos['projet_dt_inicio'] = implode("-",array_reverse(explode("/",$_POST['projet_dt_inicio'])));
				$arrCampos['projet_dt_fim'] = implode("-",array_reverse(explode("/",$_POST['projet_dt_fim'])));
				$arrCampos['projet_status'] = $_POST['projet_status'];				
				$arrCampos['projet_fase'] = $_POST['projet_fase'];
				$arrCampos['projet_descricao'] = $_POST['projet_descricao'];
				$arrCampos['projet_responsavel'] = $_POST['projet_responsavel'];
				$arrCampos['projet_dt_comemoracao'] = implode("-",array_reverse(explode("/",$_POST['projet_dt_comemoracao'])));
				$arrCampos['projet_situacao'] = $_POST['projet_situacao'];
				$arrCampos['projet_porcentagem'] = $_POST['projet_porcentagem'];
			}else{
				$arrCampos['projet_porcentagem'] = $_POST['projet_porcentagem'];
				$arrCampos['projet_status'] = $_POST['projet_status'];
				$arrCampos['projet_situacao'] = $_POST['projet_situacao'];
				$arrCampos['projet_descricao'] = $_POST['projet_descricao'];
			}

			if ($_SESSION['db']->AutoExecute("projeto",$arrCampos,"INSERT")) {

				$projet_id = $_SESSION['db']->Insert_ID();
				$arrCamposArea['projet_id'] = $projet_id;
				foreach($_POST['areas'] as $area_id) {
					$arrCamposArea['area_id'] = $area_id;
					$_SESSION['db']->AutoExecute("projeto_area",$arrCamposArea,"INSERT");
				}
				$arrCamposPilares['pilare_projet_id'] = $projet_id;
				if(is_array($arrCamposPilares['pilare_projet_id']))
				foreach($_POST['pilares'] as $pilar) {
					$arrCamposPilares[$arrpilares[$pilar]] = 1;
				}
				$_SESSION['db']->AutoExecute("pilares",$arrCamposPilares,"INSERT");

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
			if($_SESSION["l_tipo"] == "administrador") {
				$arrCampos['projet_estruturante_id'] = $_POST['projet_estruturante_id'];
				$arrCampos['projet_pai_id'] = $_POST['projet_pai_id'];
				$arrCampos['projet_titulo'] = $_POST['projet_titulo'];
				$arrCampos['projet_dt_inicio'] = implode("-",array_reverse(explode("/",$_POST['projet_dt_inicio'])));
				$arrCampos['projet_dt_fim'] = implode("-",array_reverse(explode("/",$_POST['projet_dt_fim'])));
				$arrCampos['projet_status'] = $_POST['projet_status'];				
				$arrCampos['projet_fase'] = $_POST['projet_fase'];
				$arrCampos['projet_descricao'] = $_POST['projet_descricao'];
				$arrCampos['projet_responsavel'] = $_POST['projet_responsavel'];
				$arrCampos['projet_dt_comemoracao'] = implode("-",array_reverse(explode("/",$_POST['projet_dt_comemoracao'])));
				$arrCampos['projet_situacao'] = $_POST['projet_situacao'];
				$arrCampos['projet_porcentagem'] = $_POST['projet_porcentagem'];
			}else{
				$arrCampos['projet_porcentagem'] = $_POST['projet_porcentagem'];
				$arrCampos['projet_status'] = $_POST['projet_status'];
				$arrCampos['projet_situacao'] = $_POST['projet_situacao'];
				$arrCampos['projet_descricao'] = $_POST['projet_descricao'];
			}

			if ($_SESSION['db']->AutoExecute("projeto",$arrCampos,"UPDATE","projet_id = '".$_POST['projet_id']."'")) {

				$projet_id = $_POST['projet_id'];

				$sql_area = "DELETE FROM projeto_area WHERE projet_id = '".$_POST['projet_id']."'";
				$_SESSION['db']->Execute($sql_area,false);
				$arrCamposArea['projet_id'] = $projet_id;
				if(is_array($_POST['areas']))
				foreach($_POST['areas'] as $area_id) {
					$arrCamposArea['area_id'] = $area_id;
					$_SESSION['db']->AutoExecute("projeto_area",$arrCamposArea,"INSERT");
				}

				$sql_pilares = "DELETE FROM pilares WHERE pilare_projet_id = '".$_POST['projet_id']."'";
				$_SESSION['db']->Execute($sql_pilares,false);
				$arrCamposPilares['pilare_projet_id'] = $projet_id;
				if(is_array($_POST['pilares'])){
					foreach($_POST['pilares'] as $pilar) {
						$arrCamposPilares[$arrpilares[$pilar]] = 1;
					}
					$_SESSION['db']->AutoExecute("pilares",$arrCamposPilares,"INSERT");
				}

				$ger_msg = "Alterado com sucesso!";
				$ger_msg_tipo = 1;
				$_GET['act'] = null;
			} else {
				$ger_msg = "Um erro ocorreu.";
				$ger_msg_tipo = 0;
				$_GET['act'] = "Alterar";
				$_GET['cod'] = $_POST['projet_id'];
			}
			break;
		case 'Excluir':
			if($_SESSION["l_tipo"] == "administrador") {
				$sql_vinculos = "SELECT projet_id FROM projeto WHERE projet_pai_id = '".$_GET['cod']."'";
				$rs_vinculos = $_SESSION['db']->GetAll($sql_vinculos);
				if (count($rs_vinculos) === 0) {
					$sql = "DELETE FROM projeto WHERE projet_id = '".$_GET['cod']."'";
					if ($_SESSION['db']->Execute($sql,false)){
	    	    		$_SESSION['db']->Execute("DELETE FROM pilares WHERE pilare_projet_id = '".$_GET['cod']."'",false);
	        			$_SESSION['db']->Execute("DELETE FROM projeto_area WHERE projet_id = '".$_GET['cod']."'",false);
						$ger_msg = "Excluído com sucesso!";
						$ger_msg_tipo = 1;
					} else {
						$ger_msg = "Um erro ocorreu.";
						$ger_msg_tipo = 0;
					}
				} else {
					$ger_msg = "Este projeto possui projeto(s) filho(s) e não pode ser excluido.";
					$ger_msg_tipo = 0;
				}
			}else{
				$ger_msg = "Você não possui acesso para excluir !";
				$ger_msg_tipo = 0;
			}
			$_GET['act'] = null;
			break;
	}

	include_once("cabecalho.php");
	include_once("migalhas.php");

?>

<style>
	.span6 { width: 330px; }
	.pagination2 { width: 425px; } 
</style>

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

							$("#grp_projet_peca").removeClass("error");
							$("#grp_projet_referencia").removeClass("error");
							$("#grp_projet_status").removeClass("error");

							if ($("#projet_classe_pai").val() == "") {
								$("#grp_projet_classe_pai").addClass("error");
								$("#projet_classe_pai").focus();
								error_status = true;
								return false;
							} else if ($("#projet_peca").val() == "") {
								$("#grp_projet_peca").addClass("error");
								$("#projet_peca").focus();
								error_status = true;
								return false;
							} else if ($("#projet_referencia").val() == "") {
								$("#grp_projet_referencia").addClass("error");
								if (error_status == false) {
									$("#projet_referencia").focus();
								}
								return false;
							} else if ($("#projet_status").val() == "") {
                                $("#grp_projet_status").addClass("error");
                                if (error_status == false) {
                                        $("#projet_status").focus();
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

					function area_insert(tit,cod) {
						//alert($("#area-"+cod).html());
						if ($("#area-"+cod).html() == null) {
							$("#divareas").append('<li class="active" id="area-' + cod + '"><a href="javascript:area_remove(\'' + cod + '\');">' + tit + ' &nbsp;<i class="icon-remove"></i></a><input type="hidden" name="areas[]" value="' + cod + '"></li>');
						}
					}
					function area_remove(cod) {
						if ($("#area-"+cod) != false) {
							$("#area-"+cod).fadeOut(300, function() { $(this).remove(); });
						}
					}
					function pilar_check(ele) {
						if ( ele.hasClass('active') ) {
							ele.removeClass('btn-primary');
						} else {
							ele.addClass('btn-primary');
						}
						if ( $("#pilar-hid-"+ele.attr('rel')).length == 0 ) {
							$("#divpilares").append('<input type="hidden" name="pilares[]" value="' + ele.attr('rel') + '" id="pilar-hid-' + ele.attr('rel') + '">');
						} else {
							$("#pilar-hid-"+ele.attr('rel')).remove();
						}
					}
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
								<div class="control-group" id="grp_projet_estruturante_id">
									<label class="control-label">Estruturante</label>
									<div class="controls">
										<select class="input-xlarge" name="projet_estruturante_id" id="projet_estruturante_id" <?=(($_SESSION["l_tipo"] == "administrador") ? "": "disabled")?> >
											<?
											$sql_estruturante = "SELECT estrut_id, estrut_descricao FROM estruturante ORDER BY estrut_descricao ASC";
											$rs_estruturante = $_SESSION['db']->GetAll($sql_estruturante);
											if (count($rs_estruturante) > 0) {
												echo '<option value="">Selecione um estruturante</option>';
												foreach ($rs_estruturante as $key_estruturante => $row_estruturante) {
													$estruturante_selected = ($row_estruturante['estrut_id'] == $_POST['projeto_estruturante_id']) ? "selected" : "";
													echo '<option value="'.$row_estruturante['estrut_id'].'" '.$estruturante_selected.'>'.$row_estruturante['estrut_descricao'].'</option>';
												}
											} else {
												echo '<option value="">Nenhum estruturante cadastrado</option>';
											}
											?>
										</select>
									</div>
								</div>
								<div class="control-group" id="grp_projet_pai_id">
									<label class="control-label">Projeto Pai</label>
									<div class="controls">
										<select class="input-xlarge" name="projet_pai_id" id="projet_pai_id" <?=(($_SESSION["l_tipo"] == "administrador") ? "": "disabled")?> >
											<?
											$sql_pai = "SELECT projet_id, projet_titulo FROM projeto ORDER BY projet_titulo ASC";
											$rs_pai = $_SESSION['db']->GetAll($sql_pai);
											if (count($rs_pai) > 0) {
												echo '<option value="">Selecione um projeto pai</option>';
												foreach ($rs_pai as $key_pai => $row_pai) {
													$pai_selected = ($row_pai['projet_id'] == $_POST['projet_id']) ? "selected" : "";
													echo '<option value="'.$row_pai['projet_id'].'" '.$pai_selected.'>'.$row_pai['projet_titulo'].'</option>';
												}
											} else {
												echo '<option value="">Nenhum projeto cadastrado</option>';
											}
											?>
										</select>
									</div>
								</div>
								<div class="control-group" id="grp_projet_titulo">
									<label class="control-label">Titulo</label>
									<div class="controls">
										<input type="text" class="input-xlarge" name="projet_titulo" id="projet_titulo" value="<?=$_POST['projet_titulo']?>" maxlength="255" <?=(($_SESSION["l_tipo"] == "administrador") ? "": "readonly='readonly'")?> >
									</div>
								</div>
								<div class="control-group" id="grp_projet_datas">
									<label class="control-label">Datas</label>
									<div class="controls">
										<div class="input-append date" id="dp3" data-date="<?=date("d/m/Y")?>" data-date-format="dd/mm/yyyy">
											<input class="input-small" value="<?=implode("/",array_reverse(explode("-",$_POST['projet_dt_inicio'])))?>" id="projet_dt_inicio" name="projet_dt_inicio" type="text" <?=(($_SESSION["l_tipo"] == "administrador") ? "": "readonly='readonly'")?>>
											<?=(($_SESSION["l_tipo"] == "administrador") ? '<span class="add-on"><i class="icon-th"></i></span>': '')?> 
			  							</div>
			  							&nbsp;até&nbsp;
			  							<div class="input-append date" id="dp4" data-date="<?=date("d/m/Y")?>" data-date-format="dd/mm/yyyy">
											<input class="input-small" value="<?=implode("/",array_reverse(explode("-",$_POST['projet_dt_fim'])))?>" id="projet_dt_fim" name="projet_dt_fim" type="text" <?=(($_SESSION["l_tipo"] == "administrador") ? "": "readonly='readonly'")?>>
											<?=(($_SESSION["l_tipo"] == "administrador") ? '<span class="add-on"><i class="icon-th"></i></span>' :  '')?>
										</div>
									</div>
								</div>
								<div class="control-group" id="grp_projet_datas">
									<label class="control-label">Data de comemoração</label>
									<div class="controls">
										<div class="input-append date" id="dp5" data-date="<?=date("d/m/Y")?>" data-date-format="dd/mm/yyyy">
											<input class="input-small" value="<?=implode("/",array_reverse(explode("-",$_POST['projet_dt_comemoracao'])))?>" id="projet_dt_comemoracao" name="projet_dt_comemoracao" type="text" <?=(($_SESSION["l_tipo"] == "administrador") ? "": "readonly='readonly'")?>>
											<?=(($_SESSION["l_tipo"] == "administrador") ? '<span class="add-on"><i class="icon-th"></i></span>' :  '')?>
										</div>
									</div>
								</div>
								<div class="control-group" id="grp_projet_status">
									<label class="control-label">Status</label>
									<div class="controls">
                                        <select class="input-medium" name="projet_status" id="projet_status" >
                                            <option value='1' <?=($_POST['projet_status'] == '1')?"selected":""?>>Em andamento</option>
                                            <option value='2' <?=($_POST['projet_status'] == '2')?"selected":""?>>Finalizado / Encerrado</option>
                                            <option value='3' <?=($_POST['projet_status'] == '3')?"selected":""?>>Não iniciado</option>
                                            <option value='4' <?=($_POST['projet_status'] == '4')?"selected":""?>>Cancelado</option>
                                        </select>
									</div>
								</div>
								<div class="control-group" id="grp_projet_situacao">
									<label class="control-label">Situação</label>
									<div class="controls">
                                        <select class="input-medium" name="projet_situacao" id="projet_situacao">
                                            <option value='OK' <?=($_POST['projet_situacao'] == 'OK')?"selected":""?>>OK</option>
                                            <option value='Atenção' <?=($_POST['projet_situacao'] == 'Atenção')?"selected":""?>>Atenção</option>                                            
                                            <option value='Atrasado' <?=($_POST['projet_situacao'] == 'Atrasado')?"selected":""?>>Atrasado</option>
                                            <option value='Stand By' <?=($_POST['projet_situacao'] == 'Standy By')?"selected":""?>>Stand By</option>
                                        </select>
									</div>
								</div>
								<div class="control-group" id="grp_projet_porcentagem">
									<label class="control-label">% Projeto</label>
									<div class="controls">
										<div class="input-append">
											<input type="text" class="input-mini" name="projet_porcentagem" id="projet_porcentagem" value="<?=$_POST['projet_porcentagem']?>" maxlength="3">
											<span class="add-on">%</span>
										</div>
									</div>
								</div>
								<div class="control-group" id="grp_projet_porcentagem">
									<label class="control-label">Fase Atual</label>
									<div class="controls">
                                        <select class="input-medium" name="projet_fase" id="projet_fase" <?=(($_SESSION["l_tipo"] == "administrador") ? "": "disabled")?> >
                                            <option value='Planejamento' <?=($_POST['projet_fase'] == 'Planejamento')?"selected":""?>>Planejamento</option>
                                            <option value='Execução' <?=($_POST['projet_fase'] == 'Execução')?"selected":""?>>Execução</option>
                                        </select>
									</div>
								</div>
								<div class="control-group" id="grp_projet_descricao">
									<label class="control-label">Pilares</label>
									<div class="controls">
										<button type="button" class="btn btn-small" data-toggle="button" rel="1" id="pilar-bot-1" onClick="javascript:pilar_check($(this));">Personalidade</button>
										<button type="button" class="btn btn-small" data-toggle="button" rel="2" id="pilar-bot-2" onClick="javascript:pilar_check($(this));">Conexão</button>
										<button type="button" class="btn btn-small" data-toggle="button" rel="3" id="pilar-bot-3" onClick="javascript:pilar_check($(this));">Gestão</button>
										<button type="button" class="btn btn-small" data-toggle="button" rel="4" id="pilar-bot-4" onClick="javascript:pilar_check($(this));">Serviço</button>
										<button type="button" class="btn btn-small" data-toggle="button" rel="5" id="pilar-bot-5" onClick="javascript:pilar_check($(this));">Inovação</button>
										<div id="divpilares"></div>
									</div>
								</div>
								<div class="control-group" id="grp_projet_descricao">
									<label class="control-label">Descrição</label>
									<div class="controls">
										<textarea class="input-xlarge" name="projet_descricao" id="projet_descricao" rows="5"><?=$_POST['projet_descricao']?></textarea>
									</div>
								</div>
								<div class="control-group" id="grp_projet_responsavel" <?=(($_SESSION["l_tipo"] == "administrador") ? "": "readonly='readonly'")?> >
									<label class="control-label">Responsável</label>
									<div class="controls">
										<input type="text" class="input-xlarge" name="projet_responsavel" id="projet_responsavel" value="<?=$_POST['projet_responsavel']?>" maxlength="255">
									</div>
								</div>
								<div class="control-group" id="grp_projet_areas">
									<label class="control-label">Adicionar Áreas</label>
									<div class="controls">
										<ul class="nav nav-pills">
											<?php
											$sql_unidade = "SELECT area_unidade FROM area GROUP BY area_unidade";
											$rs_unidade = $_SESSION['db']->GetAll($sql_unidade);
											if (count($rs_unidade) > 0) {
												foreach ($rs_unidade as $key_unidade => $row_unidade) {
													?>
													<li class="dropdown">
														<a class="dropdown-toggle" data-toggle="dropdown" href="#">
															<?=$row_unidade['area_unidade']?> <b class="caret"></b>
														</a>
														<ul class="dropdown-menu">
															<?php
															$sql_area = "SELECT area_id, area_descricao FROM area WHERE area_unidade = '".$row_unidade['area_unidade']."' ORDER BY area_descricao ASC";
															$rs_area = $_SESSION['db']->GetAll($sql_area);	
															if (count($rs_area) > 0) {
																foreach ($rs_area as $key_area => $row_area) {
																	echo '<a href="javascript:area_insert(\''.$row_area['area_descricao'].'\',\''.$row_area['area_id'].'\');">' . $row_area['area_descricao'] . "</a>";
																}
															}
															?>
														</ul>
													</li>

                                                <?php
												}
											} else {
												echo '<option value="">Nenhuma área cadastrada</option>';
											}
											?>
										</ul>
										<ul class="nav nav-pills" id="divareas">
											<?php
											if (is_array($_POST['areas'])) {
												$sql_atualarea = "SELECT ar.area_id, ar.area_descricao FROM area ar WHERE ar.area_id IN (".implode(",",$_POST['areas']).") ORDER BY ar.area_descricao ASC";
												$rs_atualarea = $_SESSION['db']->GetAll($sql_atualarea);	
												if (count($rs_atualarea) > 0) {
													foreach ($rs_atualarea as $key_atualarea => $row_atualarea) {
														echo '<li class="active" id="area-' . $row_atualarea['area_id'] . '"><a href="javascript:area_remove(\'' . $row_atualarea['area_id'] . '\');">' . $row_atualarea['area_descricao'] . ' &nbsp;<i class="icon-remove"></i></a><input type="hidden" name="areas[]" value="' . $row_atualarea['area_id'] . '"></li>';
													}
												}
											}
											?>
										</ul>
									</div>
								</div>
								<div class="form-actions">
									<?php if ($_SESSION["l_tipo"] == "administrador") { ?>
										<button class="btn btn-primary" type="submit">Inserir</button>
									<?php } ?>
									<a href="<?=$ger_arquivo?>" class="btn">Voltar</a>
								</div>
							</fieldset>
							</form>
				            <?php
							break;
						case "Alterar":
							$sql = "SELECT
										pr.projet_id,
										pr.projet_estruturante_id,
										pr.projet_pai_id,
										pr.projet_titulo,
										pr.projet_dt_inicio,
										pr.projet_dt_fim,
										pr.projet_status,
										pr.projet_porcentagem,
										pr.projet_fase,
										pr.projet_descricao,
										pr.projet_responsavel,
										pr.projet_situacao,
										pi.pilare_personalidade,
										pi.pilare_conexao,
										pi.pilare_gestao,
										pi.pilare_servico,
										pi.pilare_inovacao,
										pr.projet_dt_comemoracao
									FROM
										projeto pr
									LEFT JOIN
										pilares pi
									ON
										pi.pilare_projet_id = pr.projet_id
									WHERE
										pr.projet_id = '".$_GET['cod']."'";
							$rs = $_SESSION['db']->GetRow($sql);
				?>
							<form method="post" name="cadform" id="cadform" action="<?=$ger_arquivo?>?act=Atualizar" class="well form-horizontal" enctype="multipart/form-data">
								<fieldset>
								<div class="control-group" id="grp_projet_estruturante_id">
									<label class="control-label">Estruturante</label>
									<div class="controls">
										<select class="input-xlarge" name="projet_estruturante_id" id="projet_estruturante_id" <?=(($_SESSION["l_tipo"] == "administrador") ? "": "disabled")?> >
											<?php
											$sql_estruturante = "SELECT estrut_id, estrut_descricao FROM estruturante ORDER BY estrut_descricao ASC";
											$rs_estruturante = $_SESSION['db']->GetAll($sql_estruturante);
											if (count($rs_estruturante) > 0) {
												echo '<option value="">Selecione um estruturante</option>';
												foreach ($rs_estruturante as $key_estruturante => $row_estruturante) {
													$estruturante_selected = ($row_estruturante['estrut_id'] == $rs['projet_estruturante_id']) ? "selected" : "";
													echo '<option value="'.$row_estruturante['estrut_id'].'" '.$estruturante_selected.'>'.$row_estruturante['estrut_descricao'].'</option>';
												}
											} else {
												echo '<option value="">Nenhum estruturante cadastrado</option>';
											}
											?>
										</select>
									</div>
								</div>
								<div class="control-group" id="grp_projet_pai_id">
									<label class="control-label">Projeto Pai</label>
									<div class="controls">
										<select class="input-xlarge" name="projet_pai_id" id="projet_pai_id" <?=(($_SESSION["l_tipo"] == "administrador") ? "": "disabled")?>>
											<?php
											$sql_pai = "SELECT projet_id, projet_titulo FROM projeto ORDER BY projet_titulo ASC";
											$rs_pai = $_SESSION['db']->GetAll($sql_pai);
											if (count($rs_pai) > 0) {
												echo '<option value="">Selecione um projeto pai</option>';
												foreach ($rs_pai as $key_pai => $row_pai) {
													$pai_selected = ($row_pai['projet_id'] == $rs['projet_pai_id']) ? "selected" : "";
													echo '<option value="'.$row_pai['projet_id'].'" '.$pai_selected.'>'.$row_pai['projet_titulo'].'</option>';
												}
											} else {
												echo '<option value="">Nenhum projeto cadastrado</option>';
											}
											?>
										</select>
									</div>
								</div>
								<div class="control-group" id="grp_projet_titulo">
									<label class="control-label">Titulo</label>
									<div class="controls">
										<input type="text" class="input-xlarge" name="projet_titulo" id="projet_titulo" value="<?=$rs['projet_titulo']?>" maxlength="255" <?=(($_SESSION["l_tipo"] == "administrador") ? "": "readonly")?>>
									</div>
								</div>
								<div class="control-group" id="grp_projet_datas">
									<label class="control-label">Datas</label>
									<div class="controls">
										<div class="input-append date" id="dp3" data-date="<?=date("d/m/Y")?>" data-date-format="dd/mm/yyyy">
											<input class="input-small" value="<?=implode("/",array_reverse(explode("-",$rs['projet_dt_inicio'])))?>" id="projet_dt_inicio" name="projet_dt_inicio" type="text" <?=(($_SESSION["l_tipo"] == "administrador") ? "": "readonly")?>>
											<?=(($_SESSION["l_tipo"] == "administrador") ? '<span class="add-on"><i class="icon-th"></i></span>': '')?> 																							
			  							</div>
			  							&nbsp;até&nbsp;
			  							<div class="input-append date" id="dp4" data-date="<?=date("d/m/Y")?>" data-date-format="dd/mm/yyyy">
											<input class="input-small" value="<?=implode("/",array_reverse(explode("-",$rs['projet_dt_fim'])))?>" id="projet_dt_fim" name="projet_dt_fim" type="text" <?=(($_SESSION["l_tipo"] == "administrador") ? "": "readonly")?> >
											<?=(($_SESSION["l_tipo"] == "administrador") ? '<span class="add-on"><i class="icon-th"></i></span>': '')?> 
										</div>
									</div>
								</div>
								<div class="control-group" id="grp_projet_datas">
									<label class="control-label">Data de comemoração</label>
									<div class="controls">
										<div class="input-append date" id="dp5" data-date="<?=date("d/m/Y")?>" data-date-format="dd/mm/yyyy">
											<input class="input-small" value="<?=implode("/",array_reverse(explode("-",$rs['projet_dt_comemoracao'])))?>" id="projet_dt_comemoracao" name="projet_dt_comemoracao" type="text" <?=(($_SESSION["l_tipo"] == "administrador") ? "": "readonly")?> >
											<?=(($_SESSION["l_tipo"] == "administrador") ? '<span class="add-on"><i class="icon-th"></i></span>': '')?> 
										</div>
									</div>
								</div>
								<div class="control-group" id="grp_projet_status">
									<label class="control-label">Status</label>
									<div class="controls">
                                        <select class="input-medium" name="projet_status" id="projet_status">
                                            <option value='1' <?=($rs['projet_status'] == '1')?"selected":""?>>Em andamento</option>
                                            <option value='2' <?=($rs['projet_status'] == '2')?"selected":""?>>Finalizado / Encerrado</option>
                                            <option value='3' <?=($rs['projet_status'] == '3')?"selected":""?>>Não iniciado</option>
                                            <option value='4' <?=($rs['projet_status'] == '4')?"selected":""?>>Cancelado</option>
                                        </select>
									</div>
								</div>
								<div class="control-group" id="grp_projet_situacao">
									<label class="control-label">Situação</label>
									<div class="controls">
                                        <select class="input-medium" name="projet_situacao" id="projet_situacao">
                                            <option value='OK' <?=($rs['projet_situacao'] == 'OK')?"selected":""?>>OK</option>
                                            <option value='Atenção' <?=($rs['projet_situacao'] == 'Atenção')?"selected":""?>>Atenção</option>
                                            <option value='Atrasado' <?=($rs['projet_situacao'] == 'Atrasado')?"selected":""?>>Atrasado</option>
                                            <option value='Stand By' <?=($rs['projet_situacao'] == 'Stand By')?"selected":""?>>Stand By</option>
                                        </select>
									</div>
								</div>
								<div class="control-group" id="grp_projet_porcentagem">
									<label class="control-label">% Projeto</label>
									<div class="controls">
										<div class="input-append">
											<input type="text" class="input-mini" name="projet_porcentagem" id="projet_porcentagem" value="<?=$rs['projet_porcentagem']?>" maxlength="3">
											<span class="add-on">%</span>
										</div>
									</div>
								</div>
								<div class="control-group" id="grp_projet_porcentagem">
									<label class="control-label">Fase Atual</label>
									<div class="controls">
                                        <select class="input-medium" name="projet_fase" id="projet_fase" <?=(($_SESSION["l_tipo"] == "administrador") ? "": "disabled")?> >
                                            <option value='Planejamento' <?=($rs['projet_fase'] == 'Planejamento')?"selected":""?>>Planejamento</option>
                                            <option value='Execução' <?=($rs['projet_fase'] == 'Execução')?"selected":""?>>Execução</option>
                                        </select>
									</div>
								</div>
								<div class="control-group" id="grp_projet_descricao">
									<label class="control-label">Pilares</label>
									<div class="controls">
										<button type="button" class="btn btn-small <?=($rs['pilare_personalidade'])?'btn-primary active':''?>" data-toggle="button" rel="1" id="pilar-bot-1" onClick="javascript:pilar_check($(this));">Personalidade</button>
										<button type="button" class="btn btn-small <?=($rs['pilare_conexao'])?'btn-primary active':''?>" data-toggle="button" rel="2" id="pilar-bot-2" onClick="javascript:pilar_check($(this));">Conexão</button>
										<button type="button" class="btn btn-small <?=($rs['pilare_gestao'])?'btn-primary active':''?>" data-toggle="button" rel="3" id="pilar-bot-3" onClick="javascript:pilar_check($(this));">Gestão</button>
										<button type="button" class="btn btn-small <?=($rs['pilare_servico'])?'btn-primary active':''?>" data-toggle="button" rel="4" id="pilar-bot-4" onClick="javascript:pilar_check($(this));">Serviço</button>
										<button type="button" class="btn btn-small <?=($rs['pilare_inovacao'])?'btn-primary active':''?>" data-toggle="button" rel="5" id="pilar-bot-5" onClick="javascript:pilar_check($(this));">Inovação</button>
										<div id="divpilares">
										<?php
										if ($rs['pilare_personalidade']) echo '<input type="hidden" name="pilares[]" value="1" id="pilar-hid-1">';
										if ($rs['pilare_conexao']) echo '<input type="hidden" name="pilares[]" value="2" id="pilar-hid-2">';
										if ($rs['pilare_gestao']) echo '<input type="hidden" name="pilares[]" value="3" id="pilar-hid-3">';
										if ($rs['pilare_servico']) echo '<input type="hidden" name="pilares[]" value="4" id="pilar-hid-4">';
										if ($rs['pilare_inovacao']) echo '<input type="hidden" name="pilares[]" value="5" id="pilar-hid-5">';
										?>
										</div>
									</div>
								</div>
								<div class="control-group" id="grp_projet_descricao">
									<label class="control-label">Descrição</label>
									<div class="controls">
										<textarea class="input-xlarge" name="projet_descricao" id="projet_descricao" rows="5"><?=$rs['projet_descricao']?></textarea>
									</div>
								</div>
								<div class="control-group" id="grp_projet_responsavel">
									<label class="control-label">Responsável</label>
									<div class="controls">
										<input type="text" class="input-xlarge" name="projet_responsavel" id="projet_responsavel" value="<?=$rs['projet_responsavel']?>" maxlength="255"  <?=(($_SESSION["l_tipo"] == "administrador") ? "": "readonly")?>>
									</div>
								</div>
								<div class="control-group" id="grp_projet_areas">
									<label class="control-label">Adicionar Áreas</label>
									<div class="controls">
										<ul class="nav nav-pills">
											<?php
											$sql_unidade = "SELECT area_unidade FROM area GROUP BY area_unidade";
											$rs_unidade = $_SESSION['db']->GetAll($sql_unidade);
											if (count($rs_unidade) > 0) {
												foreach ($rs_unidade as $key_unidade => $row_unidade) {
													?>
													<li class="dropdown">
														<a class="dropdown-toggle" data-toggle="dropdown" href="#">
															<?=$row_unidade['area_unidade']?> <b class="caret"></b>
														</a>
														<ul class="dropdown-menu">
															<?php
															$sql_area = "SELECT area_id, area_descricao FROM area WHERE area_unidade = '".$row_unidade['area_unidade']."' ORDER BY area_descricao ASC";
															$rs_area = $_SESSION['db']->GetAll($sql_area);	
															if (count($rs_area) > 0) {
																foreach ($rs_area as $key_area => $row_area) {
																	echo '<a href="javascript:area_insert(\''.$row_area['area_descricao'].'\',\''.$row_area['area_id'].'\');">' . $row_area['area_descricao'] . "</a>";
																}
															}
															?>
														</ul>
													</li>
													<?php
												}
											} else {
												echo '<option value="">Nenhuma área cadastrada</option>';
											}
											?>
										</ul>
										<ul class="nav nav-pills" id="divareas">
											<?php
											$sql_atualarea = "SELECT ar.area_id, ar.area_descricao FROM area ar INNER JOIN projeto_area pa ON ar.area_id = pa.area_id WHERE pa.projet_id = '".$rs['projet_id']."' ORDER BY ar.area_descricao ASC";
											$rs_atualarea = $_SESSION['db']->GetAll($sql_atualarea);	
											if (count($rs_atualarea) > 0) {
												foreach ($rs_atualarea as $key_atualarea => $row_atualarea) {
													echo '<li class="active" id="area-' . $row_atualarea['area_id'] . '"><a href="javascript:area_remove(\'' . $row_atualarea['area_id'] . '\');">' . $row_atualarea['area_descricao'] . ' &nbsp;<i class="icon-remove"></i></a><input type="hidden" name="areas[]" value="' . $row_atualarea['area_id'] . '"></li>';
												}
											}
											?>
										</ul>
									</div>
								</div>
								<div class="form-actions">
									<input type="hidden" name="projet_id" value="<?=(!empty($rs['projet_id']))?$rs['projet_id']:$_GET['cod'];?>">
									<button class="btn btn-primary" type="submit">Alterar</button>
									<a href="<?=$ger_arquivo?>" class="btn">Voltar</a>
								</div>
								</fieldset>
							</form>
				<?php
							break;
						default:
				?>
							<?php if ($_SESSION["l_tipo"] == "administrador") { ?>
								<p><a href="<?=$ger_arquivo?>?act=Inserir" class="btn btn-primary" id="add_bot">Inserir</a></p>
							<?php } ?>
							<table class="table table-striped table-bordered" id="tabelacompaginacao">
							  <thead>
							    <tr>
							    <th>Titulo</th>
								<th>Dt. Inicio</th>
								<th>Dt. Fim</th>
								<th>Fase</th>
								<th>%</th>
								<th></th>
							    </tr>
							  </thead>
							  <tbody>
							  	<?php
							  	
							  	$sql = "SELECT projet_id, projet_titulo, projet_dt_inicio, projet_dt_fim, projet_fase, projet_porcentagem FROM projeto WHERE projet_pai_id = 0 
							  			" . (($_SESSION["l_tipo"] == "administrador") ? "" : " AND projet_id in (0,". $arrayAcesso[$_SESSION["l_email"]]. ") "). "
							  			ORDER BY  projet_titulo ASC";
							  	$rs = $_SESSION['db']->GetAll($sql);
							  	foreach ($rs as $key => $row) {
							  	?>
								    <tr>
								    	<td><?=$row['projet_titulo']?></td>
										<td><?=implode("/",array_reverse(explode("-",$row['projet_dt_inicio'])))?></td>
										<td><?=implode("/",array_reverse(explode("-",$row['projet_dt_fim'])))?></td>
										<td><?=$row['projet_fase']?></td>
										<td><?=$row['projet_porcentagem']?>%</td>
										<td class="span1">
											<a href="<?=$ger_arquivo?>?act=Alterar&cod=<?=$row['projet_id']?>"><i class="icon-edit" title="Alterar" alt="Alterar"></i></a>
											<?php if ($_SESSION["l_tipo"] == "administrador") { ?>
											<a href="<?=$ger_arquivo?>?act=Excluir&cod=<?=$row['projet_id']?>" class="botexcluir" title="Excluir" alt="Excluir" rel="<?=$row['projet_id']?>"><i class="icon-trash"></i></a>
											<?php } ?>
										</td>
								    </tr>
								  	<?php
								  	$sqlsub = "SELECT projet_id, projet_titulo, projet_dt_inicio, projet_dt_fim, projet_fase, projet_porcentagem FROM projeto WHERE projet_pai_id = ".$row['projet_id']." ORDER BY projet_titulo ASC";
								  	$rssub = $_SESSION['db']->GetAll($sqlsub);
								  	foreach ($rssub as $keysub => $rowsub) {
								  	?>
									    <tr>
									    	<td><?=$row['projet_titulo']?> <i class=" icon-chevron-right"></i> <?=$rowsub['projet_titulo']?></td>
											<td><?=implode("/",array_reverse(explode("-",$rowsub['projet_dt_inicio'])))?></td>
											<td><?=implode("/",array_reverse(explode("-",$rowsub['projet_dt_fim'])))?></td>
											<td><?=$rowsub['projet_fase']?></td>
											<td><?=$rowsub['projet_porcentagem']?>%</td>
											<td class="span1">
												<a href="<?=$ger_arquivo?>?act=Alterar&cod=<?=$rowsub['projet_id']?>"><i class="icon-edit" title="Alterar" alt="Alterar"></i></a>
												<?php if ($_SESSION["l_tipo"] == "administrador") { ?>
													<a href="<?=$ger_arquivo?>?act=Excluir&cod=<?=$rowsub['projet_id']?>" class="botexcluir" title="Excluir" alt="Excluir" rel="<?=$rowsub['projet_id']?>"><i class="icon-trash"></i></a>
												<?php } ?>
											</td>
									    </tr>
								  	<?php
								  	}
								  	?>
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
			</div>

	</section>

<?php
	include_once("rodape.php");
?>