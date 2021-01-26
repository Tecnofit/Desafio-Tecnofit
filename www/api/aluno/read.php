<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once '../../config/Database.php';
include_once '../../models/Aluno.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate aluno object
$aluno = new Aluno($db);

// Aluno read query
$result = $aluno->read();

// Get row count
$num = $result->rowCount();

// Check if any alunos
if ($num > 0) {
  // Cat array
  $alu_arr = array();


  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $cat_item = array(
      'id' => $id,
      'nome' => $nome,
      'email' => $email
    );

    // Push to "data"
    array_push($alu_arr, $cat_item);
  }

  // Turn to JSON & output
  echo json_encode($alu_arr);
} else {
  // No Alunos
  echo json_encode(
    array('message' => 'Alunos não encontrados')
  );
}
