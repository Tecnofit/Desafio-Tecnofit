<?php
//pega a url de onde esta vindo
 $url       = $_SERVER['HTTP_REFERER']; 
 $arrayURL  = parse_url($url);
 $urlValida = $arrayURL['path'];

// ----- verifica a url
if($urlValida=="/academia/index2.php") {

        session_start();

        $dataAtual  = date('Y-m-d');
//------- inclusao das classes
        require_once ('database.php');
        require_once ('academia.class.php');
        
//------- instancia dos objetos
        $database = new Database();
        $db = $database->getConnection();
        
//--------------- verifica se existe dados nba classe
        $aluno     = new Controle($db);
        $infoAluno = $aluno->buscaDados($urlValida, $_POST['nmLogin'], md5($_POST['nmSenha']));
        $count     = $infoAluno->rowCount();

        if($count=='1'){
                $_SESSION["email"] = $_POST['nmLogin'];
                $_SESSION["senha"] = $_POST['nmSenha'];
                header("Location: dashboard.php");
        }else{
                header("Location: index2.php");

        }
        
}

?>