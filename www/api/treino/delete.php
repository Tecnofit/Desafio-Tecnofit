<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

if ($_SERVER["REQUEST_METHOD"] == 'DELETE' || $_SERVER["REQUEST_METHOD"] == 'OPTIONS') {

  if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("HTTP/1.1 200 ");
    exit;
  }

  include_once '../../config/Database.php';
  include_once '../../models/Treino.php';
  //include_once '../../models/Exercicio.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate object
  $treino = new Treino($db);

  // Get ID
  $treino->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Verify and set ID to DELETE or exit with error
  if (!isset($treino->id)) {
    echo json_encode(
      array(
        'message' => 'Parâmetro não encontrado',
        'code' => '9'
      )
    );
    exit;
  } else {
    $return = $treino->delete();

    if ($return) {
     return null;
    } else {
      header("HTTP/1.1 406 OK");
      $array_return = array();
      $return = array(
        'message' => 'Treino não pode ser excluído',
        'code' => 0
      );
      array_push($array_return, $return);
      echo json_encode($array_return);
    }
  }
}
