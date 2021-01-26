<?php
class aluno
{
  // DB Stuff
  private $conn;
  private $table = 'alunos';

  // Properties
  public $id;
  public $nome;
  public $email;
  public $created_at;

  // Constructor with DB
  public function __construct($db)
  {
    $this->conn = $db;
  }

  // Get alunos
  public function read()
  {
    // Create query
    $query = 'SELECT
        id,
        nome,
        email,
        created_at
      FROM
        ' . $this->table . '
      ORDER BY
        created_at';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Execute query
    $stmt->execute();

    return $stmt;
  }

  // Get Single Aluno
  public function read_single()
  {
    // Create query
    $query = 'SELECT
          id,
          nome,
          email
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
      return $stmt;
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->id = $row['id'];
      $this->nome = $row['nome'];
      $this->email = $row['email'];
    } else {
      unset($this->id);
    }
  }

  // Create Aluno
  public function create()
  {
    // Create Query
    $query = "INSERT INTO $this->table (nome,email) VALUES (:nome,:email)";

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data

    $this->nome = htmlspecialchars(strip_tags($this->nome));
    $this->email = htmlspecialchars(strip_tags($this->email));

    // Bind data
    $stmt->bindParam('nome', $this->nome);
    $stmt->bindParam('email', $this->email);

    // Execute query
    if ($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
  }

  // Update Aluno
  public function update()
  {
    // Create Query
    $query = 'UPDATE ' .
      $this->table . '
    SET
      nome = :nome,
      email = :email
      WHERE id = :id';


    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->id = htmlspecialchars(strip_tags($this->id));
    $this->nome = htmlspecialchars(strip_tags($this->nome));
    $this->email = htmlspecialchars(strip_tags($this->email));

    // Bind data
    $stmt->bindParam('nome', $this->nome);
    $stmt->bindParam('email', $this->email);
    $stmt->bindParam('id', $this->id);

    // Execute query
    if ($stmt->execute()) {
      $count = $stmt->rowCount(); // check affected rows using rowCount
      if ($count > 0) {
        return true;
      } else {
        return false;
        printf("Error:\n", $stmt->errorCode(), $stmt->errorInfo());
      }
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
  }

  // Delete Aluno
  public function delete()
  {
    // Create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->id = (int)htmlspecialchars($this->id);

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
  }
}
