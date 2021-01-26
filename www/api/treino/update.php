<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

if ($_SERVER["REQUEST_METHOD"] == 'PUT' || $_SERVER["REQUEST_METHOD"] == 'OPTIONS') {


  if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("HTTP/1.1 200 ");
    exit;
  }

  include_once '../../config/Database.php';
  include_once '../../models/Treino.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate object
  $treino = new Treino($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Verify and set ID to UPDATE or exit with error
  if (!isset($data->id)) {
    print_r(json_encode(
      array(
        'message' => 'Parâmetro não encontrado',
        'code' => '9'
      )
    ));
    exit;
  } else {

    $treino->id         = $data->id;
    $treino->aluno_id  = $data->aluno_id;
    $treino->descricao  = $data->descricao;
    $treino->ativo  = $data->ativo;

    // Update
    if ($treino->update()) {
      $tre_item = array(
        'id' => $treino->id,
        'aluno_id' => $treino->aluno_id,
        'email' => $treino->descricao,
        'ativo' => $treino->ativo,
      );
      echo json_encode($tre_item);
    } else {
      http_response_code("204");
      echo json_encode(
        array(
          'message' => 'Treino não atualizado',
          'code' => '0'
        )
      );
    }
  }
}
