<?php


// Headers
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');
if ($_SERVER["REQUEST_METHOD"] == 'PUT' || $_SERVER["REQUEST_METHOD"] == 'OPTIONS') {
  include_once '../../config/Database.php';
  include_once '../../models/TreinoDetalhe.php';

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
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate object
    $treinodetalhe = new TreinoDetalhe($db);

    $treinodetalhe->treino_id     = $data->treino_id;
    $treinodetalhe->exercicio_id  = $data->exercicio_id;
    $treinodetalhe->series        = $data->series;
    $treinodetalhe->repeticoes    = $data->repeticoes;
    $treinodetalhe->status        = $data->status;
    $treinodetalhe->id    = $data->id;
    // Update
    if ($treinodetalhe->update()) {
      echo json_encode(
        array(
          'message' => 'Detalhe do Treino atualizado',
          'code' => '1'
        )
      );
    } else {
      echo json_encode(
        array(
          'message' => 'Detalhe do Treino não atualizado',
          'code' => '0'
        )
      );
    }
  }
} else {
  http_response_code(405);
}
