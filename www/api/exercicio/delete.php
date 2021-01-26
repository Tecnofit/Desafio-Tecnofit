<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

if ($_SERVER["REQUEST_METHOD"] == 'DELETE' || $_SERVER["REQUEST_METHOD"] == 'OPTIONS') {

  if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("HTTP/1.1 200 ");
    exit;
  }

  include_once '../../config/Database.php';
  include_once '../../models/Exercicio.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate object
  $exercicio = new Exercicio($db);

  // Get ID
  $exercicio->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Verify and set ID to DELETE or exit with error
  if (!isset($exercicio->id)) {
    echo json_encode(
      array(
        'message' => 'Parâmetro não encontrado',
        'code' => '9'
      )
    );
    exit;
  } else {


    // verificar se o exercício está em um treino ativo para algum aluno
    // if (!$exercicio->verificar_exercicio_treino_ativo()) {

    // Delete exercicio
    if ($exercicio->delete()) {
      echo json_encode(
        array(
          'message' => 'Exercício excluído',
          'code' => '1'
        )
      );
    } else {
      header("HTTP/1.1 406 OK"); //nao excluir exercicio em treino ativo
      // echo json_encode(
      //   array(
      //     'message' => 'Exercício não exite ou não foi excluído',
      //     'code' => '0'
      //   )
      // );
    }
  }
}
