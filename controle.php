<?php

//var_dump($_POST);


    session_start();
    $lgUsuario  = $_SESSION["email"];

    if($lgUsuario){

    
    require_once ('database.php');
    require_once ('academia.class.php');

    $database       = new Database();
    $db             = $database->getConnection();
    $infosAcademia  = new Controle($db);
    
      

//demais informacoes
switch ($_GET['tipo']) {
    
    case 'cadastrar':        
//----------------insere as informações de cadastro        
        $url         = $_SERVER['HTTP_REFERER']; 
        $arrayURL    = parse_url($url);
        $urlValida   = $arrayURL['path'];
        $infosGerais = $infosAcademia->insereDados($_POST, $urlValida);

    break;
    
    case 'deletar':
        $url         = $_SERVER['HTTP_REFERER']; 
        $arrayURL    = parse_url($url);
        $urlValida   = $arrayURL['path'];
        $infosGerais = $infosAcademia->deletaDados($_GET['registro'], $urlValida);    
    break;
    
    case 'editar':
        $url         = $_SERVER['HTTP_REFERER']; 
        $arrayURL    = parse_url($url);
        $urlValida   = $arrayURL['path'];        
        $infosGerais = $infosAcademia->atualizaDados($_POST, $urlValida); 
    break;

    case 'tipoTreino':
        $infosGerais = $infosAcademia->buscaTreinos();
        while($row = $infosGerais->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            //echo "<option id='$id_treino' name='$id_treino-$nome_treino'> $cod_treino-$nome_treino </option>";
            echo array("$id_treino","$nome_treino");
        }
    break;    



    case 'buscar':
        $url         = $_SERVER['HTTP_REFERER']; 
        $arrayURL    = parse_url($url);
        $urlValida   = $arrayURL['path'];
       
        switch ($urlValida) {
            
            case '/academia/cad_aluno.php':
                $infosGerais = $infosAcademia->buscaInfos($urlValida);
                while($row = $infosGerais->fetch(PDO::FETCH_ASSOC)){
                extract($row);            
                echo "<tr id='$id_aluno' name='$id_aluno-$nome_aluno-$idade-$email_contato'>
                        <th scope='row'>$id_aluno</th>
                        <td id='txAluno'>$nome_aluno</td>
                        <td id='txIdade'>$idade</td>
                        <td id='txEmail'>$email_contato</td>
                        <td>
                            <span class='badge badge-warning' name='btnAtualizar' onclick='carregaInfo($id_aluno)'>Atualizar</span>
                            <span class='badge badge-danger'  name='btnDeletar'   onclick='deletaInfo($id_aluno)'>Deletar</span>
                        </td>
                    </tr>";
                }
            break;

            case '/academia/cad_treino.php':
                $infosGerais = $infosAcademia->buscaInfos($urlValida);
                while($row = $infosGerais->fetch(PDO::FETCH_ASSOC)){
                extract($row);            
                echo "<tr id='$id_treino' name='$id_treino-$cod_treino-$nome_treino '>
                        <th scope='row'>$cod_treino</th>
                        <td id='txAluno'>$nome_treino</td>
                        <td>
                            <span class='badge badge-warning' name='btnAtualizar' onclick='carregaInfo($id_treino)'>Atualizar</span>
                            <span class='badge badge-danger'  name='btnDeletar'   onclick='deletaInfo($id_treino)'>Deletar</span>
                        </td>
                    </tr>";
                }
            break;

            case '/academia/cad_exercicio.php':
                $infosGerais = $infosAcademia->buscaInfos($urlValida);
                while($row = $infosGerais->fetch(PDO::FETCH_ASSOC)){
                extract($row);            
                echo "<tr id='$id_exercicio' name='$id_exercicio-$cod_exercicio-$nome_exercicio '>
                        <th scope='row'>$cod_exercicio</th>
                        <td id='txAluno'>$nome_exercicio</td>
                        <td>
                            <span class='badge badge-warning' name='btnAtualizar' onclick='carregaInfo($id_exercicio)'>Atualizar</span>
                            <span class='badge badge-danger'  name='btnDeletar'   onclick='deletaInfo($id_exercicio)'>Deletar</span>
                        </td>
                    </tr>";
                }
            break;
     
            default:
                # code...
            break;
        }

        

    break;
     
    default:
        # code...
    break;
}


} else{
    if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
 session_destroy();  
 header("Location: index2.php");
}

?>
