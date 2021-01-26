<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/TreinoDetalhe.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
// Instantiate blog treino object
$treinodetalhe = new TreinoDetalhe($db);

// Get ID
$treinodetalhe->id = isset($_GET['id']) ? $_GET['id'] : die();



// Get
$treinodetalhe->read_single();

//  var_dump($treinodetalhe);
//  exit;

if (isset($treinodetalhe->id)) {

  // Create array
  $treinodetalhe_arr = array(
    'id'            => (int)$treinodetalhe->id,
    'treino_id'     => (int)$treinodetalhe->treino_id,
    'treino'        => json_decode($treinodetalhe->treino),
    'exercicio_id'  => (int)$treinodetalhe->exercicio_id,
    'exercicio'     => json_decode($treinodetalhe->exercicio),
    'series'        => (int)$treinodetalhe->series,
    'aluno'         => json_decode($treinodetalhe->aluno),
    'repeticoes'    => (int)$treinodetalhe->repeticoes,
    'status'    => (int)$treinodetalhe->status
  );
  
  // Make JSON
  print_r(json_encode($treinodetalhe_arr));
} else {
  http_response_code(204);
  // echo json_encode(
  //   array(
  //     'message' => 'TreinoDetalhe não exite',
  //     'code' => '0'
  //   )
  // );
}
