<?php
class treino
{
  // DB Stuff
  private $conn;
  private $table = 'treinos';

  // Properties
  public $id;
  public $aluno_id;
  public $descricao;
  public $ativo;
  public $created_at;


  // Constructor with DB
  public function __construct($db)
  {
    $this->conn = $db;
  }

  // Get treinos
  public function read()
  {
    // Create query
    $query = 'SELECT
            t.id,
            t.aluno_id,
            t.descricao,
            t.ativo,
            t.created_at,
            JSON_UNQUOTE(JSON_OBJECT("id",a.id,"nome",a.nome,"email",a.email)) as aluno
        FROM
            treinos t, alunos a
        WHERE t.aluno_id=a.id
      ORDER BY t.created_at DESC';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Execute query
    $stmt->execute();

    return $stmt;
  }

  // Get Single Treino
  public function read_single()
  {
    // Create query
    $query = 'SELECT
              t.id,
              t.aluno_id,
              t.descricao,
              t.ativo,
              t.created_at,
              JSON_UNQUOTE(JSON_OBJECT("id",a.id,"nome",a.nome,"email",a.email)) as aluno
            FROM
              treinos t, alunos a
            WHERE t.aluno_id=a.id
            AND t.id= ?
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
      $this->aluno_id = $row['aluno_id'];
      $this->aluno = json_decode($row['aluno']);
      $this->descricao = $row['descricao'];
      $this->ativo = $row['ativo'];
    } else {
      unset($this->id);
    }
  }

  // Create Treino
  public function create()
  {
    // Create Query
    if ($this->ativo == 1)
      $this->atualiza_treino_ativo();

    $query = "INSERT INTO $this->table (aluno_id, descricao, ativo) VALUES (:aluno_id, :descricao, :ativo)";

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->aluno_id = htmlspecialchars(strip_tags($this->aluno_id));
    $this->descricao = htmlspecialchars(strip_tags($this->descricao));
    $this->ativo = htmlspecialchars(strip_tags($this->ativo));

    // Bind data
    $stmt->bindParam('aluno_id', $this->aluno_id);
    $stmt->bindParam('descricao', $this->descricao);
    $stmt->bindParam('ativo', $this->ativo);

    // Execute query
    if ($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
  }
  private function atualiza_treino_ativo()
  {
    $query = 'UPDATE ' .
      $this->table . '
    SET
      ativo = 0
      WHERE aluno_id = :aluno_id
      AND ativo=1';
    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    $this->aluno_id = (int)htmlspecialchars($this->aluno_id);

    // Bind data
    $stmt->bindParam('aluno_id', $this->aluno_id);

    // Execute query
    $stmt->execute();
  }
  // Update Treino
  public function update()
  {

    if ($this->ativo == 1) {
      $this->atualiza_treino_ativo();
    }
    // Create Query
    $query = 'UPDATE ' .
      $this->table . '
    SET
      aluno_id = :aluno_id,
      descricao = :descricao,
      ativo = :ativo
      WHERE
      id = :id';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->aluno_id = (int)htmlspecialchars($this->aluno_id);
    $this->descricao = htmlspecialchars(strip_tags($this->descricao));
    $this->ativo = (int) htmlspecialchars($this->ativo);
    $this->id = (int)htmlspecialchars($this->id);

    // Bind data
    $stmt->bindParam('aluno_id', $this->aluno_id);
    $stmt->bindParam('descricao', $this->descricao);
    $stmt->bindParam('ativo', $this->ativo);
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

  // Delete Treino
  public function delete()
  {
    // treino não pode ser deletado se estiver ativo
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id and ativo =0';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->id = htmlspecialchars(strip_tags($this->id));

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
      // return true;
    }


    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
  }
}
