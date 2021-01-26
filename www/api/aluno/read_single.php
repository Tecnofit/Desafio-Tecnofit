<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Aluno.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
// Instantiate blog aluno object
$aluno = new Aluno($db);

// Get ID
$aluno->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get
$result = $aluno->read_single();
if (isset($aluno->id)) {

  $alu_arr = array();
  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $cat_item = array(
      'id' => (int)$id,
      'nome' => $nome,
      'email' => $email
    );

    // Push to "data"
    //array_push($alu_arr, $cat_item);
  }

  // Turn to JSON & output
  echo json_encode($cat_item);
} else {
  // No Alunos
  echo json_encode(
    array('message' => 'Alunos não encontrados')
  );
}
