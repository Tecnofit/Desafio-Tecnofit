<?php
  session_start();
  include __DIR__."/db.php";
  include __DIR__."/functions.php";
  $db = conn();
  $alunos='';
  $i=1;

  if (isset($_POST["nome"]) and isset($_POST["adicionar"])){
    cadastraAluno($_POST);

  }elseif(isset($_POST["nome"]) and isset($_POST["editar"])){
    atualizaAluno($_POST);

  }elseif (isset($_POST["excluir"])) {
    excluiAluno($_POST);
  }

  buscaAlunos();
?>

<html lang="pt-br">

<head>

<title>Alunos</title>
<?php include("head.php"); ?>

</head>

<body>

  <br><h2>Alunos</h2><br>

  <?php if (isset($_GET['nome'])): ?>

    <?php

    $sqlStatusFicha = "select * from `fichaexercicios` where nomeAluno = '".$_GET['nome']."' group by statusFicha;";
    $resultStatusFicha = $db->query($sqlStatusFicha);
    while ($row = mysqli_fetch_assoc($resultStatusFicha)) {
      $statusFichaArray[$i]= $row['statusFicha'];
      //echo $row['statusFicha'];
      $i++;
    }


    if (isset($statusFichaArray)) {
      array_unique($statusFichaArray,SORT_STRING);
      if (array_search("Ativa",$statusFichaArray) == true) {
        $statusFicha="Ativa";
      }elseif (array_search("Aguardando Início",$statusFichaArray) == true) {
        $statusFicha="Aguardando Início";
      }elseif (array_search("Concluída",$statusFichaArray) == true) {
        $statusFicha="Concluída";
      }
    }else {
      $statusFicha="Sem Ficha de Exercícios";
    }
    ?>
    <div class="col-12 row">
      <div class="col-md-3 left-panel-div">
        <table>
          <tbody>
            <div style="text-align: end" class="col-sm-12">
                <a class="btn btn-primary" href="alunos.php" type="submit" value="+">+ Novo</a>
            </div>
            <?php echo $alunos; ?>
          </tbody>
        </table>
      </div>

        <div class="col-md-9 right-panel-div">

          <form id="alunoCadastro" method="post" action="alunos.php">
            <div class="form-group row ">
              <label for="nome" class="col-sm-1 col-form-label">Nome</label>
              <div class="col-sm-9">
                <input type="text" class="form-control " id="nome" name="nome" value=<?php echo "'".$_GET["nome"]."'"; ?> required>
              </div>
            </div>

            <div class="form-group row">
              <label for="email" class="col-sm-1 col-form-label">E-mail</label>
              <div class="col-sm-9">
                <input type="email" class="form-control" id="email" name="email" value=<?php echo $_GET["email"]; ?>>
              </div>
            </div>

            <div class="form-row row">
              <div class="col-md-5 mb-3">
                <label for="dataNascimento">Data de Nascimento</label>
                <input type="date" class="form-control" id="dataNascimento" name="dataNascimento" value=<?php echo $_GET["dataNascimento"]; ?>>
              </div>
              <div class="col-md-5 mb-3">
                <label for="sexo">Sexo</label>
                <select id="sexo" name="sexo" class="form-control">
                  <option selected><?php echo $_GET["sexo"]; ?></option>
                  <option value="Masculino">Masculino</option>
                  <option value="Feminino">Feminino</option>
                  <option value="Outro">Outro</option>
                </select>
              </div>
            </div>
              <div class="form-row">
                <div class="col-md-5 mb-3">
                  <label for="cpf">CPF</label>
                  <input type="text" class="form-control" id="cpf" name="cpf" value=<?php echo $_GET["cpf"]; ?>>
                </div>
                <div class="col-md-5 mb-3">
                  <label for="estadoCivil">Estado Civil</label>
                  <select id="estadoCivil" class="form-control" name="estadoCivil">
                    <option selected><?php echo $_GET["estadoCivil"]; ?></option>
                    <option value="Solteiro">Solteiro</option>
                    <option value="Casado">Casado</option>
                    <option value="Divorciado">Divorciado</option>
                    <option value="Viuvo">Viuvo</option>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label for="telefone" class="col-sm-1 col-form-label">Telefone</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="telefone" name="telefone" value=<?php echo $_GET["telefone"]; ?>>
                </div>
              </div>

              <div class="form-row">
                <div class="col-md-5 mb-3">
                  <label for="endereco">Endereço</label>
                  <input type="text" class="form-control" id="endereco" name="endereco" value=<?php echo $_GET["endereco"]; ?>>
                </div>
                <div class="col-md-5 mb-3">
                  <label for="numero">Número</label>
                  <input type="text" class="form-control" id="numero" name="numero" value=<?php echo $_GET["numero"]; ?>>
                </div>
              </div>

              <div class="form-row">
                <div class="col-md-5 mb-3">
                  <label for="complemento">Complemento</label>
                  <input type="text" class="form-control" id="complemento" name="complemento" value=<?php echo $_GET["complemento"]; ?>>
                </div>
                <div class="col-md-5 mb-3">
                  <label for="bairro">Bairro</label>
                  <input type="text" class="form-control" id="bairro" name="bairro" value=<?php echo $_GET["bairro"]; ?>>
                </div>
              </div>

              <div class="form-row">
                <div class="col-md-5 mb-3">
                  <label for="cidade">Cidade</label>
                  <input type="text" class="form-control" id="cidade" name="cidade" value=<?php echo $_GET["cidade"]; ?>>
                </div>
                <div class="col-md-5 mb-3">
                  <label for="estado">Estado</label>
                  <input type="text" class="form-control" id="estado" name="estado" value=<?php echo $_GET["estado"]; ?>>
                </div>
              </div>

              <div class="form-group row">
                <label for="cep" class="col-sm-1 col-form-label">CEP</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="cep" name="cep" value=<?php echo $_GET["cep"]; ?>>
                </div>
              </div>

              <div class="form-group row">
                <label for="cep" class="col-sm-2 col-form-label">Status Ficha</label>
                <div class="col-sm-8">
                  <select id="statusFicha" class="form-control" name="statusFicha" readonly>
                    <option selected><?php echo $statusFicha; ?></option>

                  </select>
                </div>
              </div>


              <input type="text" name="editar" style="display:none;">
              <input type="text" name="id"  value="<?php echo $_GET['id'] ?>" style="display:none;">


            </form>

            <div class="row">
              <div class="col-sm-6 ">
                <form action="alunos.php" method="post">
                    <input type="text" name="id"  value="<?php echo $_GET['id'] ?>" style="display:none;">
                    <input type="text" name="excluir" style="display:none;">
                    <input class="btn btn-danger" type="submit" value="Excluir">
                </form>
              </div>
              <div class="col-sm-4 " style="text-align: end">
                <form action="alunos.php" method="post">
                  <input class="btn btn-primary" type="submit" value="Salvar" form="alunoCadastro">
                </form>
              </div>
          </div>
          </div>
        </div>


  <?php else: ?>
    <form method="post" action="alunos.php">
    <div class="col-12 row">
      <div class="col-md-3 left-panel-div">
        <table>
          <tbody>
            <div style="text-align: end" class="col-sm-12">
                <a class="btn btn-primary" href="alunos.php" type="submit" value="+">+ Novo</a>
            </div>
            <?php echo $alunos; ?>
          </tbody>
        </table>
      </div>

        <div class="col-md-9 right-panel-div">

          <?php if(isset($_SESSION['temp'])){

            if ($_SESSION['temp'] == 1){

              echo "<div class='alert alert-success col-md-10' role='alert' id='temp'>  Cadastro Realizado com Sucesso! </div>";
              unset($_SESSION['temp']);

            }elseif ($_SESSION['temp'] == 2) {

              echo "<div class='alert alert-success col-md-10' role='alert' id='temp'>  Cadastro Alterado com Sucesso! </div>";
                unset($_SESSION['temp']);

            }elseif ($_SESSION['temp'] == 3) {

                echo "<div class='alert alert-danger col-md-10' role='alert' id='temp'>  Cadastro Excluido com Sucesso! </div>";
                unset($_SESSION['temp']);
            }

          }
          ?>

          <div class="form-group row ">
            <label for="nome" class="col-sm-1 col-form-label">Nome</label>
            <div class="col-sm-9">
              <input type="text" class="form-control " id="nome" name="nome" placeholder="Nome" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="email" class="col-sm-1 col-form-label">E-mail</label>
            <div class="col-sm-9">
              <input type="email" class="form-control" id="email" name="email" placeholder="exemplo@teste.com">
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-5 mb-3">
              <label for="dataNascimento">Data de Nascimento</label>
              <input type="date" class="form-control" id="dataNascimento" name="dataNascimento" placeholder="01/01/2001">
            </div>
            <div class="col-md-5 mb-3">
              <label for="sexo">Sexo</label>
              <select id="sexo" name="sexo" class="form-control">
                <option selected>Escolher...</option>
                <option value="Masculino">Masculino</option>
                <option value="Feminino">Feminino</option>
                <option value="Outro">Outro</option>
              </select>
            </div>
          </div>
            <div class="form-row">
              <div class="col-md-5 mb-3">
                <label for="cpf">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="000.000.000-00">
              </div>
              <div class="col-md-5 mb-3">
                <label for="estadoCivil">Estado Civil</label>
                <select id="estadoCivil" class="form-control" name="estadoCivil">
                  <option selected>Escolher...</option>
                  <option value="Solteiro">Solteiro</option>
                  <option value="Casado">Casado</option>
                  <option value="Divorciado">Divorciado</option>
                  <option value="Viuvo">Viuvo</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="telefone" class="col-sm-1 col-form-label">Telefone</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(00)0000-0000">
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-5 mb-3">
                <label for="endereco">Endereço</label>
                <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Rua exemplo">
              </div>
              <div class="col-md-5 mb-3">
                <label for="numero">Número</label>
                <input type="text" class="form-control" id="numero" name="numero" placeholder="000">
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-5 mb-3">
                <label for="complemento">Complemento</label>
                <input type="text" class="form-control" id="complemento" name="complemento" placeholder="Apto 000">
              </div>
              <div class="col-md-5 mb-3">
                <label for="bairro">Bairro</label>
                <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro">
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-5 mb-3">
                <label for="cidade">Cidade</label>
                <input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade">
              </div>
              <div class="col-md-5 mb-3">
                <label for="estado">Estado</label>
                <input type="text" class="form-control" id="estado" name="estado" placeholder="Estado">
              </div>
            </div>

            <div class="form-group row">
              <label for="cep" class="col-sm-1 col-form-label">CEP</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="cep" name="cep" placeholder="00000-000">
              </div>
            </div>

            <div class="form-group row">
              <label for="cep" class="col-sm-2 col-form-label">Status Ficha</label>
              <div class="col-sm-8">
                <select id="statusFicha" class="form-control" name="statusFicha">
                  <option selected>Escolher...</option>
                  <option value="Ativa">Ativa</option>
                  <option value="Aguardando">Aguardando Início</option>
                  <option value="Concluída">Concluída</option>
                  <option value="Sem Ficha de Exercícios">Sem Ficha de Exercícios</option>
                </select>
              </div>
            </div>

            <input type="text" name="adicionar" style="display:none;">

            <div style="text-align: end" class="col-sm-10">
              <input class="btn btn-primary" type="submit" value="Cadastrar">
            </div>
      </div>
    </div>
  </form>
  <?php endif; ?>

  <?php include("bootstrap.php"); ?>

</body>
