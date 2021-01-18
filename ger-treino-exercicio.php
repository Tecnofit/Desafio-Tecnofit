<?php
$ger_nome = "Exercicios no meu treino";
$ger_slug = "exercicios-treino";
$ger_arquivo = "ger-treino-exercicio.php";

include_once("funcoes.php");

logged();

switch ($_GET['act']) {
    case 'Gravar':
        $arrCampos['treino_usuario_id_sessao'] = $_SESSION['l_cod'];
        $arrCampos['treino_exercicio_treino_usuario_id'] = $_POST['cod_treino_usuario'];
        $arrCampos['treino_exercicio_exerci_id'] = $_POST['treino_exercicio_exerci_id'];
        $arrCampos['treino_exercicio_num_sessoes'] = $_POST['treino_exercicio_num_sessoes'];
        $arrCampos['treino_exercicio_status'] = $_POST['treino_exercicio_status'];

//        $sqlStatus = "SELECT count(1) as total FROM treino_usuario WHERE treino_usuario_status = 'Ativo' and treino_usuario_usuari_id = ". $_SESSION['l_cod'];
//        $rsStatus = $_SESSION['db']->GetRow($sqlStatus);
//
//        if($rsStatus['total'] > 0 && $_POST['treino_usuario_status'] == 'Ativo') {
//            $ger_msg = "[3] Já existe uma treino em atividade, por favor verifique se existe outro treino ativo " . $ger_nome;
//            $ger_msg_tipo = 0;
//            $_GET['act'] = "Inserir";
//        }else {

            if ($_SESSION['db']->AutoExecute("treino_exercicio",$arrCampos,"INSERT")) {
                $ger_msg = $ger_nome . " gravado com sucesso!";
                $ger_msg_tipo = 1;
                $_GET['act'] = null;
            } else {
                $ger_msg = "[1] Um erro ocorreu no cadastro de " . $ger_nome;
                $ger_msg_tipo = 0;
                $_GET['act'] = "Inserir";
            }
       // }
        break;
    case 'Atualizar':

        break;
    case 'Excluir':
        $sql = "SELECT treino_exercicio_id FROM treino_exercicio WHERE treino_exercicio_id = '".$_GET['cod']."'";
        $rs = $_SESSION['db']->GetRow($sql);
        $sql = "DELETE FROM treino_exercicio WHERE treino_exercicio_id = '".$_GET['cod']."'";
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

$sqltreino = "SELECT treino_usuario_descricao FROM treino_usuario WHERE treino_usuario_id = '".$_GET['cod_treino_usuario']."'";
$rsTreino = $_SESSION['db']->GetRow($sqltreino);

?>

    <section id="<?=$ger_slug?>">
        <div class="row">
            <div class="span3"><?php include_once("menu-lateral.php"); ?></div>
            <div class="span9">
                <h3><?=$rsTreino['treino_usuario_descricao']?></h3>
                <script>
                    $(document).ready(function(){
                        $("#cadform").bind("submit",function(){
                            var error_status = false;

                            $("#grp_treino_usuario_descricao").removeClass("error");

                            if ($("#treino_exercicio_descricao").val() == "") {
                                $("#grp_treino_exercicio_descricao").addClass("error");
                                $("#treino_exercicio_descricao").focus();
                                error_status = true;
                                return false;
                            } else {
                                return true;
                            }
                        });
                        $(".botexcluir").bind("click",function(){
                            popup_excluir_treinos("<?=$ger_arquivo?>?cod_treino_usuario=<?=$_GET['cod_treino_usuario']?>",$(this).attr("rel"));
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
                        <form method="post" name="cadform" id="cadform" action="<?=$ger_arquivo?>?act=Gravar&cod_treino_usuario=<?=$_GET['cod_treino_usuario']?>" class="well form-horizontal" enctype="multipart/form-data">
                            <fieldset>
                                <div class="control-group" id="grp_projet_pai_id">
                                    <label class="control-label">Exercicio</label>
                                    <div class="controls">
                                        <select class="input-xlarge" name="treino_exercicio_exerci_id" id="treino_exercicio_exerci_id" >
                                            <?php
                                            $sql_pai = "SELECT exerci_id, exerci_descricao FROM exercicios ORDER BY exerci_descricao ASC";
                                            $rs_pai = $_SESSION['db']->GetAll($sql_pai);
                                            if (count($rs_pai) > 0) {
                                                echo '<option value="">Selecione um Exercicio</option>';
                                                foreach ($rs_pai as $key_pai => $row_pai) {
                                                    $pai_selected = ($row_pai['exerci_id'] == $rs['treino_exercicio_exerci_id']) ? "selected" : "";
                                                    echo '<option value="'.$row_pai['exerci_id'].'" '.$pai_selected.'>'.$row_pai['exerci_descricao'].'</option>';
                                                }
                                            } else {
                                                echo '<option value="">Nenhum exercicio disponivel</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="control-group" id="grp_treino_usuario_status">
                                    <label class="control-label">Status</label>
                                    <div class="controls">
                                        <select class="input-medium" name="treino_exercicio_status" id="treino_exercicio_status">
                                            <option value='Finalizado' <?=($_POST['treino_exercicio_status'] == 'Finalizado')?"selected":""?>>Finalizado</option>
                                            <option value='Pular' <?=($_POST['treino_exercicio_status'] == 'Pular')?"selected":""?>>Pular</option>
                                            <option value='Não iniciado' <?=($_POST['treino_exercicio_status'] == 'Não iniciado')?"selected":""?>>Não iniciado</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group" id="grp_projet_porcentagem">
                                    <label class="control-label">Número de sessões</label>
                                    <div class="controls">
                                        <div class="input-append">
                                            <input type="text" class="input-mini" name="treino_exercicio_num_sessoes" id="treino_exercicio_num_sessoes" value="<?=$_POST['treino_exercicio_num_sessoes']?>" maxlength="3">
                                            <span class="add-on"> X </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button class="btn btn-primary" type="submit">Inserir</button>
                                    <input type="hidden" name="cod_treino_usuario" value="<?=$_GET['cod_treino_usuario']?>">
                                    <a href="ger-treino-usuario.php" class="btn">Voltar</a>
                                </div>
                            </fieldset>
                        </form>
                        <?php
                        break;
                    case "Alterar":
                        $sql = "SELECT treino_usuario_id, treino_usuario_descricao, treino_usuario_status FROM treino_usuario WHERE treino_usuario_id = '".$_GET['cod']."'";
                        $rs = $_SESSION['db']->GetRow($sql);
                        ?>
                        <form method="post" name="cadform" id="cadform" action="<?=$ger_arquivo?>?act=Atualizar" class="well form-horizontal">
                            <fieldset>
                                <div class="control-group" id="grp_treino_usuario_descricao">
                                    <label class="control-label">Descrição</label>
                                    <div class="controls">
                                        <textarea class="input-xxlarge" name="treino_usuario_descricao" rows="4" id="treino_usuario_descricao"><?=$rs['treino_usuario_descricao']?></textarea>
                                    </div>
                                </div>
                                <div class="control-group" id="grp_treino_usuario_status">
                                    <label class="control-label">Status</label>
                                    <div class="controls">
                                        <select class="input-medium" name="treino_usuario_status" id="treino_usuario_status">
                                            <option value='Ativo' <?=($rs['treino_usuario_status'] == 'Ativo')?"selected":""?>>Ativo</option>
                                            <option value='Inativo' <?=($rs['treino_usuario_status'] == 'Inativo')?"selected":""?>>Inativo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="hidden" name="treino_exercicio_id" value="<?=$rs['treino_exercicio_id']?>">
                                    <input type="hidden" name="cod_treino_usuario" value="<?=$_GET['cod_treino_usuario']?>"
                                    <button class="btn btn-primary" type="submit">Alterar</button>
                                    <a href="<?=$ger_arquivo?>" class="btn">Voltar</a>
                                </div>
                            </fieldset>
                        </form>
                        <?php
                        break;
                    default:
                        ?>
                        <p><a href="<?=$ger_arquivo?>?act=Inserir&cod_treino_usuario=<?=$_GET['cod_treino_usuario']?>" class="btn btn-primary" id="add_bot">Inserir</a></p>
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Exercicio</th>
                                <th>Sessões</th>
                                <th>Status</th>
                                <th colspan="2">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql = "SELECT treino_exercicio_id, treino_exercicio_num_sessoes, treino_exercicio_status, 
                                        (SELECT exerci_descricao from exercicios where exerci_id = treino_exercicio_exerci_id) as nome_exercicio 
                                    FROM `treino_exercicio` 
                                    WHERE treino_usuario_id_sessao = ".$_SESSION['l_cod']." 
                                    and `treino_exercicio_treino_usuario_id` = ".(int) $_GET['cod_treino_usuario'] ."
                                    order by treino_exercicio_id DESC ";
                            $rs = $_SESSION['db']->GetAll($sql);
                            foreach ($rs as $key => $row) {
                                ?>
                                <tr>
                                    <td><?=$row['nome_exercicio']?></td>
                                    <td><?=$row['treino_exercicio_num_sessoes']?></td>
                                    <td><?=(($row['treino_exercicio_status'] == 'Finalizado') ? "Finalizado" :
                                            (($row['treino_exercicio_status'] == 'Pular') ? "Pular" : "Inativo"))?></td>
                                    <td class="span1"><a href="#" class="botexcluir" rel="<?=$row['treino_exercicio_id']?>"><i class="icon-trash"></i></a></td>
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