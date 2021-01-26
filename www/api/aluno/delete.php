<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Headers: *');
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == 'DELETE' || $_SERVER["REQUEST_METHOD"] == 'OPTIONS') {

  if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("HTTP/1.1 200 ");
    exit;
  }

  include_once '../../config/Database.php';
  include_once '../../models/Aluno.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate object
  $aluno = new Aluno($db);

  // Get ID
  $aluno->id = isset($_GET['id']) ? $_GET['id'] : die();


  // Verify and set ID to DELETE or exit with error
  if (!isset($aluno->id)) {
    echo json_encode(
      array(
        'message' => 'Parâmetro não encontrado',
        'code' => '9'
      )
    );
    exit;
  } else {


    // Delete
    if ($aluno->delete()) {
      return null;
      // echo json_encode(
      //   array(
      //     'message' => 'Aluno excluído',
      //     'code' => '1'
      //   )
      // );
    } else {
      echo json_encode(
        array(
          'message' => 'Aluno não exite ou não foi excluído',
          'code' => '0'
        )
      );
    }
  }
}