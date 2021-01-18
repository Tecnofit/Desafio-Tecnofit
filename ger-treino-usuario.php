<?php
$ger_nome = "Meu Treino";
$ger_slug = "treino";
$ger_arquivo = "ger-treino-usuario.php";

include_once("funcoes.php");

logged();

switch ($_GET['act']) {
    case 'Gravar':
        $arrCampos['treino_usuario_usuari_id'] = $_SESSION['l_cod'];
        $arrCampos['treino_usuario_status'] = 'Inativo';
        $arrCampos['treino_usuario_descricao'] = $_POST['treino_usuario_descricao'];

        $sqlStatus = "SELECT count(1) as total FROM treino_usuario WHERE treino_usuario_status = 'Ativo' and treino_usuario_usuari_id = ". $_SESSION['l_cod'];
        $rsStatus = $_SESSION['db']->GetRow($sqlStatus);

        if($rsStatus['total'] > 0 && $_POST['treino_usuario_status'] == 'Ativo') {
            $ger_msg = "[3] Já existe uma treino em atividade, por favor verifique se existe outro treino ativo " . $ger_nome;
            $ger_msg_tipo = 0;
            $_GET['act'] = "Inserir";
        }else {

            if ($_SESSION['db']->AutoExecute("treino_usuario",$arrCampos,"INSERT")) {
                $ger_msg = $ger_nome . " gravado com sucesso!";
                $ger_msg_tipo = 1;
                $_GET['act'] = null;
            } else {
                $ger_msg = "[1] Um erro ocorreu no cadastro de " . $ger_nome;
                $ger_msg_tipo = 0;
                $_GET['act'] = "Inserir";
            }
        }
        break;
    case 'Atualizar':
        $arrCampos['treino_usuario_usuari_id'] = $_SESSION['l_cod'];
        $arrCampos['treino_usuario_status'] = $_POST['treino_usuario_status'];
        $arrCampos['treino_usuario_descricao'] = $_POST['treino_usuario_descricao'];

        $sqlStatus = "SELECT count(1) as total FROM treino_usuario WHERE treino_usuario_status = 'Ativo' and treino_usuario_usuari_id = ". $_SESSION['l_cod'];
        $rsStatus = $_SESSION['db']->GetRow($sqlStatus);

        if($rsStatus['total'] > 0 && $_POST['treino_usuario_status'] == 'Ativo') {
            $ger_msg = "[3] Já existe uma treino em atividade, por favor verifique se existe outro treino ativo " . $ger_nome;
            $ger_msg_tipo = 0;
            $_GET['act'] = "Alterar";
            $_GET['cod'] = $_POST['treino_usuario_id'];
        }else {
            if ($_SESSION['db']->AutoExecute("treino_usuario", $arrCampos, "UPDATE", "treino_usuario_id = '" . $_POST['treino_usuario_id'] . "'")) {
                $ger_msg = $ger_nome . " alterado(a) com sucesso!";
                $ger_msg_tipo = 1;
                $_GET['act'] = null;
            } else {
                $ger_msg = "[2] Um erro ocorreu no cadastro de " . $ger_nome;
                $ger_msg_tipo = 0;
                $_GET['act'] = "Alterar";
                $_GET['cod'] = $_POST['treino_usuario_id'];
            }
        }
        break;
    case 'Excluir':
        $sql = "SELECT treino_usuario_id FROM treino_usuario WHERE treino_usuario_id = '".$_GET['cod']."'";
        $rs = $_SESSION['db']->GetRow($sql);
        $sql = "DELETE FROM treino_usuario WHERE treino_usuario_id = '".$_GET['cod']."'";
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

                            $("#grp_treino_usuario_descricao").removeClass("error");

                            if ($("#treino_usuario_descricao").val() == "") {
                                $("#grp_usuario_descricao").addClass("error");
                                $("#treino_usuario_descricao").focus();
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
                                <div class="control-group" id="grp_treino_usuario_descricao">
                                    <label class="control-label">Nome do Treino</label>
                                    <div class="controls">
                                        <textarea class="input-xxlarge" name="treino_usuario_descricao" rows="4" id="treino_usuario_descricao"><?=$_POST['treino_usuario_descricao']?></textarea>
                                    </div>
                                </div>
                                <div class="control-group" id="grp_treino_usuario_status">
                                    <label class="control-label">Status</label>
                                    <div class="controls">
                                        <select class="input-medium" name="treino_usuario_status" id="treino_usuario_status">
                                            <option value='Ativo' <?=($_POST['treino_usuario_status'] == 'Ativo')?"selected":""?>>Ativo</option>
                                            <option value='Inativo' <?=($_POST['treino_usuario_status'] == 'Inativo')?"selected":""?>>Inativo</option>
                                        </select>
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
                                    <input type="hidden" name="treino_usuario_id" value="<?=$rs['treino_usuario_id']?>">
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
                                <th>Status</th>
                                <th colspan="2">Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql = "SELECT treino_usuario_id, treino_usuario_descricao, treino_usuario_status FROM treino_usuario 
                                    where treino_usuario_usuari_id = ".$_SESSION['l_cod']." order by treino_usuario_id DESC ";
                            $rs = $_SESSION['db']->GetAll($sql);
                            foreach ($rs as $key => $row) {
                                ?>
                                <tr>
                                    <td><?=$row['treino_usuario_descricao']?></td>
                                    <td><?=(($row['treino_usuario_status'] == 'Ativo') ? "Ativo" : "Inativo")?></td>
                                    <td class="span1"><a href="<?=$ger_arquivo?>?act=Alterar&cod=<?=$row['treino_usuario_id']?>"><i class="icon-edit"></i></a></td>
                                    <td class="span1"><a href="ger-treino-exercicio.php?cod_treino_usuario=<?=$row['treino_usuario_id']?>"><i class="icon-th-list"></i></a></td>
                                    <td class="span1"><a href="#" class="botexcluir" rel="<?=$row['treino_usuario_id']?>"><i class="icon-trash"></i></a></td>
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