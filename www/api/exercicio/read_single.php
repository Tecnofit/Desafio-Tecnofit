<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Exercicio.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
// Instantiate blog exercicio object
$exercicio = new Exercicio($db);

// Get ID
$exercicio->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get
$exercicio->read_single();
if (isset($exercicio->id)) {

  // Create array
  $exercicio_arr = array(
    'id' => $exercicio->id,
    'nome' => $exercicio->nome
  );
  // Make JSON
  print_r(json_encode($exercicio_arr));
} else {
  echo json_encode(
    array(
      'message' => 'Exercicio não exite',
      'code' => '0'
    )
  );
}
