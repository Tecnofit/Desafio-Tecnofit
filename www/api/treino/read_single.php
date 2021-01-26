<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Treino.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
// Instantiate blog treino object
$treino = new Treino($db);

// Get ID
$treino->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get
$treino->read_single();
 $tre_arr = array();
if (isset($treino->id)) {

  // Create array
  $treino_arr = array(
    'id'        => (int)$treino->id,
    'aluno_id' => (int)$treino->aluno_id,
    'aluno' => $treino->aluno,
    'descricao' => $treino->descricao,
    'ativo' => (int)$treino->ativo
  );

  // Make JSON
   array_push($tre_arr, $treino_arr);
  print_r(json_encode($treino_arr));
} else {
  echo json_encode(
    array(
      'message' => 'Treino não exite',
      'code' => '0'
    )
  );
}
