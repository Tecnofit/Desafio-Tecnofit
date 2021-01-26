<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');
if ($_SERVER["REQUEST_METHOD"] == 'DELETE' || $_SERVER["REQUEST_METHOD"] == 'OPTIONS') {
  if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("HTTP/1.1 200 ");
    echo "options";
    exit;
  }
  include_once '../../config/Database.php';
  include_once '../../models/TreinoDetalhe.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate object
  $treinodetalhe = new TreinoDetalhe($db);

  // Get ID
  $treinodetalhe->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Verify and set ID to DELETE or exit with error
  if (!isset($treinodetalhe->id)) {
    echo json_encode(
      array(
        'message' => 'Parâmetro não encontrado',
        'code' => '9'
      )
    );

  } else {
    // Entendo que o exercício pode ser deletado ao editar o detalhe do treino. 
    //O exercício não pode ser deletado diretamente pela api "exercicio" caso ele esteja em algum treino ativo

    $return = $treinodetalhe->delete();

    if ($return) {
      return null;
      // echo json_encode(
      //   array(
      //     'message' => 'Detalhe do Treino excluído',
      //     'code' => '1'
      //   )
      // );
    } else {
      http_response_code(406);
      $array_return = array();
      $return = array(
          'message' => 'Não foram encontrados detalhes para esse treino',
          'code' =>0
      );
      array_push($array_return, $return);
      echo json_encode($array_return);
    }
  }
} else {
  http_response_code(405);
}
