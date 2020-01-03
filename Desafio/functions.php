<?php
//-------------------------------------------------------------Alunos----------------------------------------------------------------------//
//busca os exercícios no banco de dados
function buscaAlunos(){
  global $db;
  global $alunos;
  //Pesquisa no banco de dados e retorna os IDs e Nomes dos alunos já cadastrados (Por GET ;-;)
  $sqlAlunos = 'select * from `alunos`;';
  $resultAlunos = $db->query($sqlAlunos);
  while ($row = mysqli_fetch_assoc($resultAlunos)) {
    $alunos.="<tr><td><a href='?nome=".$row['nome'].
              "&email=".$row['email'].
              "&dataNascimento=".$row['dataNascimento'].
              "&cpf=".$row['cpf'].
              "&sexo=".$row['sexo'].
              "&estadoCivil=".$row['estadoCivil'].
              "&telefone=".$row['telefone'].
              "&endereco=".$row['endereco'].
              "&numero=".$row['numero'].
              "&complemento=".$row['complemento'].
              "&bairro=".$row['bairro'].
              "&cidade=".$row['cidade'].
              "&estado=".$row['estado'].
              "&cep=".$row['cep'].
              "&statusFicha=".$row['statusFicha'].
              "&id=".$row['id']."'>".$row['id'].' - '.$row['nome']."</a></td></tr>";
  }
}

//Cadastra o Aluno no banco de dados
function cadastraAluno($post){
  global $db;
  $sql = "insert into alunos(`nome`,
                            `email`,
                            `dataNascimento`,
                            `sexo`,
                            `cpf`,
                            `estadoCivil`,
                            `telefone`,
                            `endereco`,
                            `numero`,
                            `complemento`,
                            `bairro`,
                            `cidade`,
                            `estado`,
                            `cep`,
                            `statusFicha`,
                            `dataCadastro`)
                            values
                            ('".$post["nome"]."',
                            '".$post["email"]."',
                            '".$post["dataNascimento"]."',
                            '".$post["sexo"]."',
                            '".$post["cpf"]."',
                            '".$post["estadoCivil"]."',
                            '".$post["telefone"]."',
                            '".$post["endereco"]."',
                            '".$post["numero"]."',
                            '".$post["complemento"]."',
                            '".$post["bairro"]."',
                            '".$post["cidade"]."',
                            '".$post["estado"]."',
                            '".$post["cep"]."',
                            '".$post["statusFicha"]."',
                            '".date("Y-m-d H:i:s")."');";

  $result = $db->query($sql);
  //cria uma sessão para apresentar uma mensagem de cadastro realizado
  if ($result == true) {
    $_SESSION['temp']=1;
  }
}

//Atualiza o aluno no banco de dados
function atualizaAluno($post){
  global $db;
  $sql = "UPDATE `alunos` SET
  `nome`='".$post['nome']."',
  `email`='".$post['email']."',
  `dataNascimento`='".$post['dataNascimento']."',
  `sexo`='".$post['sexo']."',
  `cpf`='".$post['cpf']."',
  `estadoCivil`='".$post['estadoCivil']."',
  `telefone`='".$post['telefone']."',
  `endereco`='".$post['endereco']."',
  `numero`='".$post['numero']."',
  `complemento`='".$post['complemento']."',
  `bairro`='".$post['bairro']."',
  `cidade`='".$post['cidade']."',
  `estado`='".$post['estado']."',
  `cep`='".$post['cep']."',
  `statusFicha`='".$post['statusFicha']."'
  WHERE id = '".$post['id']."';";

  $result = $db->query($sql);
  //cria uma sessão para apresentar uma div de cadastro realizado
  if ($result == true) {
    $_SESSION['temp']=2;
  }
}

//Exclui o aluno do banco de dados
function excluiAluno($post){
  global $db;
  $sql = "DELETE FROM `alunos` WHERE id = '".$post['id']."';";

  $result = $db->query($sql);
  //cria uma sessão para apresentar uma mensagem de exclusão realizada
  if ($result == true) {
    $_SESSION['temp']=3;
  }
}
//----------------------------------------------------------Exercícios--------------------------------------------------------------------//
//busca os exercícios no banco de dados
function buscaExercicios(){
  //Pesquisa no banco de dados e retorna os IDs e Nomes dos exercicios já cadastrados (Por GET ;-;)
  global $db;
  global $exercicios;
  $sqlExercicios = 'select * from `exercicios`;';
  $resultExercicios = $db->query($sqlExercicios);
  while ($row = mysqli_fetch_assoc($resultExercicios)) {
    $exercicios.="<tr><td><a href='?grupoMuscular=".$row['grupoMuscular'].
                  "&nomeExercicio=".$row['nomeExercicio'].
                  "&descricaoExercicio=".$row['descricaoExercicio'].
                  "&id=".$row['id']."'>".$row['id'].' - '.$row['nomeExercicio']."</a></td></tr>";
  }
}

//Cadastra o exercício no banco de dados
function cadastrarExercicio($post){
  global $db;
  $sql = "insert into exercicios(`grupoMuscular`,
                            `nomeExercicio`,
                            `descricaoExercicio`,
                            `dataCadastro`)
                            values
                            ('".$post["grupoMuscular"]."',
                            '".$post["nomeExercicio"]."',
                            '".$post["descricaoExercicio"]."',
                            '".date("Y-m-d H:i:s")."');";

  $result = $db->query($sql);
  //cria uma sessão para apresentar uma mensagem de cadastro realizado
  if ($result == true) {
    $_SESSION['temp']=1;
  }
}

//Atualiza o exercício no banco de dados
function atualizaExercicio($post){

  global $db;
  $sql = "UPDATE `exercicios` SET `grupoMuscular`='".$_POST['grupoMuscular']."', `nomeExercicio`='".$_POST['nomeExercicio']."',
  `descricaoExercicio`='".$_POST['descricaoExercicio']."'WHERE id = '".$_POST['id']."';";

  $result = $db->query($sql);
  //cria uma sessão para apresentar uma mensagem de atualização realizada
  if ($result == true) {
    $_SESSION['temp']=2;
  }
}

//Exclui o exercício do banco de dados
function excluiExercicio($post){
  global $db;
  //Faz uma busca para verificar se o exercício está em algum treino atual
  $sql = "select * from treino where nomeExercicio = '".$post['nomeExercicio']."';";
  $result = $db->query($sql);

  //Se o exercício estiver num treino ele não pode ser excluído
  if ($result->num_rows > 0) {
    //cria uma sessão para apresentar uma mensagem de exclusão não realizada
    $_SESSION['temp']=4;
  }else {
    $sql = "DELETE FROM `exercicios` WHERE id = '".$post['id']."';";

    $result = $db->query($sql);
    //cria uma sessão para apresentar uma mensagem de exclusão realizada
    if ($result == true) {
      $_SESSION['temp']=3;
    }
  }
}
//---------------------------------------------------------ficha de Exercícios-------------------------------------------------------------//
//busca as Fichas de Exercícios no banco de dados
function buscaFicha(){
  global $db;
  global $FichaExercicios;
  //Pesquisa no banco de dados e retorna os IDs e Nomes dos exercicios já cadastrados (Por GET ;-;)
  $sqlFichaExercicios = 'select * from `fichaexercicios`;';
  $resultFichaExercicios = $db->query($sqlFichaExercicios);
  while ($row = mysqli_fetch_assoc($resultFichaExercicios)) {
    $FichaExercicios.="<tr><td><a href='?nomeAluno=".$row['nomeAluno'].
                            "&nomeFicha=".$row['nomeFicha'].
                            "&dataInicio=".$row['dataInicio'].
                            "&numeroTreinos=".$row['numeroTreinos'].
                            "&statusFicha=".$row['statusFicha'].
                            "&id=".$row['id']."'>".$row['id'].' - '.$row['nomeFicha']."</a></td></tr>";
  }

}

//Cadastra as Fichas de Exercícios no banco de dados
function cadastraFicha($post){
  global $db;
  $sqlFichaAtiva = "select * from fichaexercicios where nomeAluno = '".$post["nomeAluno"]."' and statusFicha = 'Ativa';";

  $resultFichaAtiva = $db->query($sqlFichaAtiva);
  //cria uma sessão para apresentar uma mensagem de cadastro realizado
  if ($resultFichaAtiva->num_rows > 0) {

    $sql = "insert into fichaexercicios(`nomeAluno`,
                              `nomeFicha`,
                              `dataInicio`,
                              `numeroTreinos`,
                              `statusFicha`,
                              `dataCadastro`)
                              values
                              ('".$post["nomeAluno"]."',
                              '".$post["nomeFicha"]."',
                              '".$post["dataInicio"]."',
                              '".$post["numeroTreinos"]."',
                              '".'Aguardando Início'."',
                              '".date("Y-m-d H:i:s")."');";

    $result = $db->query($sql);
    //cria uma sessão para apresentar uma mensagem de cadastro realizado
    if ($result == true) {
      $_SESSION['temp']='fichaAtiva';
    }

  }else{
    $sql = "insert into fichaexercicios(`nomeAluno`,
                              `nomeFicha`,
                              `dataInicio`,
                              `numeroTreinos`,
                              `statusFicha`,
                              `dataCadastro`)
                              values
                              ('".$post["nomeAluno"]."',
                              '".$post["nomeFicha"]."',
                              '".$post["dataInicio"]."',
                              '".$post["numeroTreinos"]."',
                              '".$post["statusFicha"]."',
                              '".date("Y-m-d H:i:s")."');";

    $result = $db->query($sql);
    //cria uma sessão para apresentar uma mensagem de cadastro realizado
    if ($result == true) {
      $_SESSION['temp']=1;
    }
  }
}

//Atualiza as Fichas de Exercícios no banco de dados
function atualizaFicha($post){
  global $db;
  $sql = "UPDATE `fichaexercicios` SET `nomeAluno`='".$post['nomeAluno']."',
                                      `nomeFicha`='".$post['nomeFicha']."',
                                      `dataInicio`='".$post['dataInicio']."',
                                      `numeroTreinos`='".$post['numeroTreinos']."',
                                      `statusFicha`='".$post['statusFicha']."'WHERE id = '".$_POST['id']."';";

  $result = $db->query($sql);
  //cria uma sessão para apresentar uma div de cadastro realizado
  if ($result == true) {
    $_SESSION['temp']=2;
  }
}

//Exclui as Fichas de Exercícios do banco de dados
function excluiFicha($post){
  global $db;

  $sql = "DELETE FROM `fichaexercicios` WHERE id = '".$post['id']."';";

  $result = $db->query($sql);
  //cria uma sessão para apresentar uma div de cadastro realizado
  if ($result == true) {
    $_SESSION['temp']=3;
  }
}

//Cadastra os Treinos da Ficha de Exercício no banco de dados
function adicionaTreino($post){
  global $db;
  global $sql;
  $id = $post['id'];
  for ($i=0; $i < count($post['serie']); $i++) {
    $sql .= "('".$id."','".$post['nomeExercicio'][$i]."',
                      '".$post['serie'][$i]."',
                      '".$post['repeticao'][$i]."',
                      '".$post['carga'][$i]."','".date("Y-m-d H:i:s")."'),";
  }

  $sql = "INSERT INTO `treino`(`idFicha`, `nomeExercicio`, `serie`, `repeticao`, `carga`, `dataCriacao`) VALUES ".substr($sql,0,-1).";";

  $result = $db->query($sql);
  //cria uma sessão para apresentar uma div de cadastro realizado
  if ($result == true) {}
}

//Exclui os Treinos da Fichas de Exercícios no banco de dados
function excluiTreino($post){
  global $db;
  $sql = "delete from `treino` where idFicha='".$post["id"]."';";

  $result = $db->query($sql);

  if ($result == true) {
    $_SESSION['temp']=4;
  }
}

//busca os Treinos das Fichas de Exercícios no banco de dados
function buscaTreino(){
  $selectExercicios='';
  global $db;
  global $selectExercicios;
  $sqlExercicios = 'select * from `exercicios`;';
  $resultExercicios = $db->query($sqlExercicios);
  while ($row = mysqli_fetch_assoc($resultExercicios)) {
    $selectExercicios.="<option value='".$row['nomeExercicio']."'>".$row['nomeExercicio']."</option>";
  }

  $sqlTreino = "select * from `treino` where idFicha  = '".$_GET['id']."';";
  $resultTreino = $db->query($sqlTreino);

  if ($resultTreino->num_rows > 0) {



    echo "<form action='fichaExercicios.php' method='post'>
            <input type='text' name='id'  value='".$_GET['id']."' style='display:none;'>
            <input class='btn btn-danger 'type='submit' name='Salvar' value='Excluir Treino'></input>
            <input type='text' name='excluirTreino'  value='excluirTreino' style='display:none;'>
          </form>
    <h3>Treino </h3><br>
              <table class='table table-bordered'>
                <thead>
                  <tr>
                    <th scope='col'>Nome exercicio</th>
                    <th scope='col'>Serie</th>
                    <th scope='col'>Repetição</th>
                    <th scope='col'>Carga(Kg)</th>
                    <th scope='col'>Status Exercício</th>
                  </tr>
                </thead>";
    while ($row = mysqli_fetch_assoc($resultTreino)) {
      echo "<tr><td>".$row['nomeExercicio']."</td><td>".$row['serie']."</td><td>".$row['repeticao']."</td><td>".$row['carga']."</td><td>".$row['statusExercicio']."</td></tr>";
    }
    echo "</table>" ;
  }else {

    echo "<div class='row'>
            <div class='col-sm-6 '>
              <input class='btn btn-primary 'type='button' name='Adicionar' onclick='addmore()' value='Adicionar Campos'></input>
            </div>
            <div class='col-sm-5' style='text-align: end'>
              <input class='btn btn-primary 'type='submit' name='Salvar' value='Salvar Treino' form='form'></input>
            </div>
          </div>

    <form action='fichaExercicios.php' method='post' id='form'>
        <input type='text' name='id'  value='".$_GET['id']."' style='display:none;'>
        <input type='text' name='adicionarTreino' style='display:none;'>
        <div class='form-row row'>
          <div class='col-md-3 mb-3'>
            <label for='nomeExercicio'>Nome do Exercício</label>
            <select id='nomeExercicio' name='nomeExercicio[]' class='form-control'>
            ".$selectExercicios."
            </select>
          </div>

          <div class='col-md-3 mb-3'>
            <label for='serie'>Série</label>
            <input type='text' class='form-control' id='serie' name='serie[]'>
          </div>

          <div class='col-md-3 mb-3'>
            <label for='repeticao'>Repetição</label>
            <input type='text' class='form-control' id='repeticao' name='repeticao[]'>
          </div>

          <div class='col-md-2 mb-3'>
            <label for='carga'>Carga (Kg)</label>
            <input type='text' class='form-control' id='carga' name='carga[]'>
          </div>

        </div>

      </form>";
  }
}
//busca os Treinos das Fichas de Exercícios no banco de dados para o terminal
function buscaTreinoTerminal(){
  global $db;
  $sqlTreinoTerminal = "select * from `treino` where idFicha = '".$_SESSION['idFicha']."';";
  $resultTreinoTerminal = $db->query($sqlTreinoTerminal);

  if ($resultTreinoTerminal->num_rows > 0) {

    echo "
    <h3>Treino </h3><br>
              <table class='table table-bordered'>
                <thead>
                  <tr>
                    <th scope='col'>Nome exercicio</th>
                    <th scope='col'>Serie</th>
                    <th scope='col'>Repetição</th>
                    <th scope='col'>Carga(Kg)</th>
                    <th scope='col'>Status Atual</th>
                    <th scope='col'>Alterar Status</th>
                  </tr>
                </thead>";
    while ($row = mysqli_fetch_assoc($resultTreinoTerminal)) {
      echo "<tr>
      <td>".$row['nomeExercicio']."</td>
      <td>".$row['serie']."</td>
      <td>".$row['repeticao']."</td>
      <td>".$row['carga']."</td>
      <td>".$row['statusExercicio']."</td><td><div>
      <div class='row'>
        <div class='col-sm-3'>
          <form action='treino.php' method='post'>
            <input type='text' name='id'  value='".$row['id']."' style='display:none;'>
            <input class='btn btn-success 'type='submit' name='concluirExercicio' value='Concluir'></input>
          </form>
        </div>
        <div class='col-sm-3'>
          <form action='treino.php' method='post'>
            <input type='text' name='id'  value='".$row['id']."' style='display:none;'>
            <input class='btn btn-warning 'type='submit' name='pularExercicio' value='Pular'></input>
          </form>
        </div>
      </div>
      </td>
      </tr>";
    }
    echo "</table>" ;
  }
}
//--------------------------------------------------------------------Terminal-------------------------------------------------------------//

function login($post){
  global $db;
  $sqlLogin = "select * from `alunos` where cpf = '".$_POST['cpf']."';";
  $resultLogin = $db->query($sqlLogin);
  if ($resultLogin->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($resultLogin)) {
      $sqlFichaId = "select * from fichaexercicios where nomeAluno = '".$row["nome"]."' and statusFicha = 'Ativa';";

      $resultFichaId = $db->query($sqlFichaId);
      if ($resultFichaId == true) {
        while ($row = mysqli_fetch_assoc($resultFichaId)) {
          $_SESSION['idFicha'] = $row['id'];
        }
      }
    }
    $_SESSION['logado']='sim';
    echo "<script>location.href = 'treino.php';</script>";
  }else {
    $_SESSION['temp']='desconhecido';
  }
}

function logado(){
  if (isset($_SESSION['logado'])) {
    if ($_SESSION['logado'] == 'sim') {
    }else {
      echo "<script>location.href = 'terminal.php';</script>";
    }
  }
}

?>
