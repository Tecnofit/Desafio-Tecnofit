<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/TreinoDetalhe.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate treino object
$treinodetalhe = new TreinoDetalhe($db);

// Get ID

$treinodetalhe->treino_id = isset($_GET['treino_id']) ? $_GET['treino_id'] :die();

if (!isset($treinodetalhe->treino_id)) {
  echo json_encode(
    array(
      'message' => 'Parâmetro não encontrado',
      'code' => '9'
    )
  );
  exit;
} else {

  // TreinoDetalhe read query
  $result = $treinodetalhe->readByTreino();

  // Get row count
  $num = $result->rowCount();

  // Check if any treinodetalhes
  if ($num > 0) {
    // Cat array
    $tre_arr = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $cat_item = array(
        'id'            => $id,
        'treino_id'     => $treino_id,
        'aluno'         =>  json_decode($aluno),
        //'treino'        => json_decode($treino),
        'exercicio_id'  => $exercicio_id,
        'exercicio'     => json_decode($exercicio),
        'series'        => $series,
        'repeticoes'    => $repeticoes,
        'status'        => $status
      );
      // Push to "data"
      array_push($tre_arr, $cat_item);
    }

    // Turn to JSON & output
    echo json_encode($tre_arr);

  } else {
    // sem treino detalhes
    //http_response_code(204); //respeitando boas práticas, a preferencia por responsa json em api
    $array_return = array();
    $return = array(
        'message' => 'Não foram encontrados detalhes para esse treino',
        'code' =>0
    );
    array_push($array_return, $return);
    echo json_encode($array_return);
  }
}
