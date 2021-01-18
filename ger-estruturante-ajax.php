<?php
	include_once("funcoes.php");
	logged();
?>
	  				<div class="accordion" id="accordion">

	  					<?php
	  					$sql = "
	  					SELECT treino_usuario_descricao, treino_usuario_status, exerci_descricao, treino_exercicio_status, treino_usuario_id_sessao,
	  					treino_exercicio_num_sessoes
	  					FROM treino_exercicio
                        INNER JOIN exercicios on exercicios.exerci_id = treino_exercicio_exerci_id
                        INNER JOIN treino_usuario on treino_usuario.treino_usuario_id = treino_exercicio_treino_usuario_id
                        WHERE 
                            treino_usuario_id_sessao = ".$_SESSION['l_cod']."
                            and treino_usuario_status = 'Ativo'
                        ORDER BY treino_exercicio_id DESC";

						$rsTreino = $_SESSION['db']->GetAll($sql);

						if(is_array($rsTreino) && !empty($rsTreino)) {
                            foreach ($rsTreino as $chaveTreino => $linhaTreino) {
                            ?>
                            <div class="accordion-group">
                                <div class="accordion-heading">
                                    <div style='height: 60px;'>
                                        <div>
                                            <a style='height: 45px;' class="accordion-toggle btn" data-toggle="collapse" data-parent="#accordion<?/*<?=$linhaProjeto['projet_id']?> Habiiltar isso para abrir mais de um projeto ao mesmo tempo*/?>" href="#collapse<?=$linhaTreino['treino_usuario_id_sessao']?>">
                                                <div class="pull-left">
                                                    <span class='titulo_projeto'><?=$linhaTreino['exerci_descricao']?></span><br/>
                                                </div>
                                                <div class="pull-right">
                                                    <div class="progresso-texto">
                                                        <span class="status-standby">SERIES:</span>
                                                        <span class="label label-info standby"><?=$linhaTreino['treino_exercicio_num_sessoes']?> X </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p style='margin: 6px 0px; 3px 0px;'></p>
                            <?php }
                        }else{
						    echo 'Ops!! Você não possue nenhum treino ativo!';
                        }?>
	  				</div>