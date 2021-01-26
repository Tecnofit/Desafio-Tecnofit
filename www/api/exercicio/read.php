<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Exercicio.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate exercicio object
  $exercicio = new Exercicio($db);

  // Exercicio read query
  $result = $exercicio->read();

  // Get row count
  $num = $result->rowCount();

  // Check if any exercicios
  if($num > 0) {
        // Cat array
        $exe_arr = array();
        $exe_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $cat_item = array(
            'id' => $id,
            'nome' => $nome

          );

          // Push to "data"
          array_push($exe_arr, $cat_item);
        }

        // Turn to JSON & output
        echo json_encode($exe_arr);

  } else {
        // No Exercicios
        echo json_encode(
          array('message' => 'Exercicios não encontrados')
        );
  }
