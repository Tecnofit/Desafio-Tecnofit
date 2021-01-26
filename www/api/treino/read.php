<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Treino.php';
//  include_once '../../models/Aluno.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate treino object
  $treino = new Treino($db);

  // Treino read query
  $result = $treino->read();

  // Get row count
  $num = $result->rowCount();

  // Check if any treinos
  if($num > 0) {
        // Cat array
        $tre_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);
          $cat_item = array(
            'id'        => $id,
            'aluno_id' => $aluno_id,
            'aluno' => json_decode($aluno),
            'descricao' => $descricao,
            'ativo' => $ativo
          );

          // Push to "data"
          array_push($tre_arr, $cat_item);
        }

        // Turn to JSON & output
        echo json_encode($tre_arr);

  } else {
        // No Treinos
        echo json_encode(
          array('message' => 'Treinos não encontrados',
          'code' => '0')
        );
  }
