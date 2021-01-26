<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT,OPTIONS');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

if ($_SERVER["REQUEST_METHOD"] == 'PUT' || $_SERVER["REQUEST_METHOD"] == 'OPTIONS') {


  if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("HTTP/1.1 200 ");
    exit;
  }

  include_once '../../config/Database.php';
  include_once '../../models/Aluno.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $aluno = new Aluno($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Verify and set ID to UPDATE or exit with error
  if (!isset($data->id)) {
    echo json_encode(
      array(
        'message' => 'Parâmetro não encontrado',
        'code' => '9'
      )
    );
    exit;
  } else {

    $aluno->id = $data->id;
    $aluno->nome = $data->nome;
    $aluno->email = $data->email;


    // Update
    if ($aluno->update()) {
      $alu_item = array(
        'id' => $aluno->id,
        'nome' => $aluno->nome,
        'email' => $aluno->email
      );
      echo json_encode($alu_item);
    } else {

      echo json_encode(
        array(
          'message' => 'Aluno não atualizado',
          'code' => '0'
        )
      );
    }
  }
}
