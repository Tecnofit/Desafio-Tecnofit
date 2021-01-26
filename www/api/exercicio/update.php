<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Exercicio.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate object
  $exercicio = new Exercicio($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

 // Verify and set ID to UPDATE or exit with error
if (!isset($data->id)) {
  echo json_encode(
    array('message' => 'Parâmetro não encontrado',
          'code' =>'9')
  );
  exit;
} else {

  $exercicio->id = $data->id;
  $exercicio->nome = $data->nome;

  // Update
  if($exercicio->update()) {
    echo json_encode(
      array('message' => 'Exercicio atualizado',
      'code' =>'1')
    );
  } else {
    echo json_encode(
      array('message' => 'Exercicio não atualizado',
      'code' =>'0')
    );
  }
}
