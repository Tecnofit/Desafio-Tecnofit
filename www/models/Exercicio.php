<?php
class exercicio
{
  // DB Stuff
  private $conn;
  private $table = 'exercicios';

  // Properties
  public $id;
  public $nome;
  public $created_at;

  // Constructor with DB
  public function __construct($db)
  {
    $this->conn = $db;
  }

  // Get exercicios
  public function read()
  {
    // Create query
    $query = 'SELECT
        id,
        nome,
        created_at
      FROM
        ' . $this->table . '
      ORDER BY
        created_at DESC';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Execute query
    $stmt->execute();

    return $stmt;
  }

  // Get Single Exercicio
  public function read_single()
  {
    // Create query
    $query = 'SELECT
          id,
          nome
        FROM
          ' . $this->table . '
      WHERE id = ?
      LIMIT 0,1';

    //Prepare statement
    $stmt = $this->conn->prepare($query);

    // Bind ID
    $stmt->bindParam(1, $this->id);

    // Execute query
    $stmt->execute();
    $count = $stmt->rowCount(); // check affected rows using rowCount
    if ($count > 0) {

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->id = $row['id'];
      $this->nome = $row['nome'];
    } else {
      unset($this->id);
    }
  }

  // Create Exercicio
  public function create()
  {
    // Create Query
    $query = "INSERT INTO $this->table (nome) VALUES (:nome)";

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data

    $this->nome = htmlspecialchars(strip_tags($this->nome));

    // Bind data
    $stmt->bindParam('nome', $this->nome);

    // Execute query
    if ($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
  }

  // Update Exercicio
  public function update()
  {
    // Create Query
    $query = 'UPDATE ' .
      $this->table . '
    SET
      nome = :nome
      WHERE
      id = :id';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->id = htmlspecialchars(strip_tags($this->id));
    $this->nome = htmlspecialchars(strip_tags($this->nome));

    // Bind data
    $stmt->bindParam('nome', $this->nome);
    $stmt->bindParam('id', $this->id);

    // Execute query
    if ($stmt->execute()) {
      $count = $stmt->rowCount(); // check affected rows using rowCount
      if ($count > 0) {
        return true;
      } else {
        return false;
      }
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
  }

  // Delete Exercicio
  public function delete()
  {
    if (!$this->verificar_exercicio_treino_ativo()) {
      // Create query
      $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

      // Prepare Statement
      $stmt = $this->conn->prepare($query);

      // Bind Data
      $stmt->bindParam('id', $this->id);

      // Execute query
      if ($stmt->execute()) {
        $count = $stmt->rowCount(); // check affected rows using rowCount
        if ($count > 0) {
          return true;
        } else {
          return false;
        }
        return true;
      }

      // Print error if something goes wrong
      printf("Error: $s.\n", $stmt->error);

      return false;
    } else {
      return false;
    }
  }

  //funcao deve estar no treino
  private function verificar_exercicio_treino_ativo()
  {
    //Verificar se exercício está em um treino ativo

    $query = 'SELECT  td.exercicio_id
              FROM treino_detalhes td, treinos t, exercicios e
              WHERE   t.id = td.treino_id
              AND     td.exercicio_id = :id
              AND     e.id=td.exercicio_id
              AND t.ativo=1';

    // Prepare statement
    $stmt = $this->conn->prepare($query);
    // Bind Data
    $stmt->bindParam('id', $this->id);


    // Execute query
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return true;
    } else {

      return false;
    }
  }
}
