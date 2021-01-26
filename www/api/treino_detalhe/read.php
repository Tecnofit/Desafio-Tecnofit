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

  // TreinoDetalhe read query
  $result = $treinodetalhe->read();

  // Get row count
  $num = $result->rowCount();

  // Check if any treinodetalhes
  if($num > 0) {
        // Cat array
        $tre_arr = array();
        $tre_arr= array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $cat_item = array(
            'id'            => $id,
            'treino_id'     => $treino_id,
            'treino'        => json_decode($treino),
            'exercicio_id'  => $exercicio_id,
            'exercicio'     => json_decode($exercicio),
            'series'        => $series,
            'repeticoes'    => $repeticoes,
            'status'    => $status
          );
          // Push to "data"
          array_push($tre_arr, $cat_item);
        }

        // Turn to JSON & output
        echo json_encode($tre_arr);

  } else {
        // No Treinos
        echo json_encode(
          array('message' => 'Treino não encontrado',
          'code' =>'0')
        );

  }
