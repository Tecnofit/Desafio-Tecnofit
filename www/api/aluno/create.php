<?php
// Headers
header('Access-Control-Allow-Origin: http://localhost:4200');
header('Access-Control-Allow-Methods: OPTIONS,POST');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json');


if ($_SERVER["REQUEST_METHOD"] == 'POST' || $_SERVER["REQUEST_METHOD"] == 'OPTIONS') {

  if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("HTTP/1.1 200 ");
    exit;
  }

  include_once '../../config/Database.php';
  include_once '../../models/Aluno.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate object
  $aluno = new Aluno($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Verify and set NAME and EMAIL to CREATE or exit with error
  if (!isset($data->nome) || !isset($data->email)) {
    echo json_encode(
      array(
        'message' => 'Parâmetro não encontrado',
        'code' => '9'
      )
    );
    exit;
  } else {

    $aluno->nome = $data->nome;
    $aluno->email = $data->email;
 
    // Criar Aluno
    if ($aluno->create()) {
      echo json_encode(
        array(
          'message' => 'Aluno criado com sucesso',
          'code' => '1'
        )
      );
    } else {
      echo json_encode(
        array(
          'message' => 'Não foi possível criar Aluno',
          'code' => '0'
        )
      );
    }
  }
} else {
  http_response_code(405);
}
