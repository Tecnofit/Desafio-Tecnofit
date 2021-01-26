<?php
class treinodetalhe
{
  // DB Stuff
  private $conn;
  private $table = 'treino_detalhes';

  // Properties
  public $id;
  public $treino_id;
  public $exercicio_id;
  public $aluno;
  public $series;
  public $repeticoes;
  public $status;
  public $created_at;

  // Constructor with DB
  public function __construct($db)
  {
    $this->conn = $db;
  }

  // Get treino detalhes
  public function read()
  {
    // Create query
    $query = 'SELECT    td.id, td.treino_id, td.status,
                  JSON_OBJECT("id", t.id, "descricao",t.descricao) as treino,
                  td.exercicio_id,JSON_OBJECT("id", e.id, "nome", e.nome) as exercicio, 
                  td.series, td.repeticoes, td.created_at
              FROM      treino_detalhes td, treinos t, exercicios e, alunos a
              WHERE     td.treino_id=t.id
              AND       td.exercicio_id = e.id
              AND       t.aluno_id = a.id
              ORDER BY  td.created_at DESC
              ';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Execute query
    $stmt->execute();

    return $stmt;
  }

  // Get treino detalhes
  public function readByTreino()
  {
 
    $query = ' SELECT    td.id, 
    td.treino_id, td.status,
    JSON_OBJECT("id", a.id, "nome", a.nome, "email", a.email) as aluno,
        JSON_OBJECT("id",t.id, "aluno_id", t.aluno_id, "aluno",JSON_OBJECT("id", a.id, "nome", a.nome, "email", a.email),t.descricao, t.ativo) as "treino",
        td.exercicio_id,
        JSON_OBJECT("id", e.id, "nome", e.nome) as exercicio, 
        td.series, td.repeticoes, td.created_at
      FROM      treino_detalhes td, treinos t, exercicios e, alunos a
      WHERE     td.treino_id=t.id
      AND       td.exercicio_id = e.id
      AND       t.aluno_id = a.id
      AND       td.treino_id = :treino_id
      ORDER BY  td.created_at DESC';


    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // clear and Bind treino_id
    $this->treino_id = (int)htmlspecialchars($this->treino_id);

    $stmt->bindParam('treino_id', $this->treino_id);

    // Execute query
    $stmt->execute();

    return $stmt;
  }



  // Get Single Treino
  public function read_single()
  {

    $query = ' SELECT    td.id, 
    td.treino_id, td.status,
    JSON_OBJECT("id",a.id, "nome",a.nome, "email", a.email) as aluno,
        JSON_OBJECT("id",t.id, "aluno_id", t.aluno_id, "aluno",JSON_OBJECT("id", a.id, "nome", a.nome, "email", a.email),t.descricao, t.ativo) as "treino",
        td.exercicio_id,
        JSON_OBJECT("id", e.id, "nome", e.nome) as exercicio, 
        td.series, td.repeticoes, td.created_at
      FROM      treino_detalhes td, treinos t, exercicios e, alunos a
      WHERE     td.treino_id=t.id
      AND       td.exercicio_id = e.id
      AND       t.aluno_id = a.id
      AND       td.id = :id
      ORDER BY  td.created_at DESC';

    //Prepare statement
    $stmt = $this->conn->prepare($query);

    // Bind ID
    // clear and Bind treino_id
    $this->treino_id = htmlspecialchars($this->id);

    $stmt->bindParam('id', $this->id);

    // Execute query
    $stmt->execute();

    $count = $stmt->rowCount(); // check affected rows using rowCount
    if ($count > 0) {

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->id             = $row['id'];
      $this->treino_id      = $row['treino_id'];
      $this->treino         = $row['treino'];
      $this->exercicio_id   = $row['exercicio_id'];
      $this->exercicio      = $row['exercicio'];
      $this->series         = $row['series'];
      $this->repeticoes     = $row['repeticoes'];
      $this->aluno         = $row['aluno'];
    } else {

      $this->id             =0;
      $this->treino_id      = $this->treino_id;
      $this->treino         = null;
      $this->exercicio_id   = 0;
      $this->exercicio      = null;
      $this->series         = 0;
      $this->repeticoes     = 0;
      $this->aluno         =  null;
      //unset($this->treino_id);
    }
  }

  // Create Treino
  public function create()
  {
    // Create Query
    $query = "INSERT INTO $this->table (treino_id, exercicio_id, series, repeticoes, status ) VALUES (:treino_id, :exercicio_id, :series, :repeticoes, :status)";

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->treino_id = (int)htmlspecialchars($this->treino_id);
    $this->exercicio_id = (int)htmlspecialchars($this->exercicio_id);
    $this->series = (int)htmlspecialchars($this->series);
    $this->repeticoes = (int)htmlspecialchars($this->repeticoes);
    $this->status = (int)htmlspecialchars($this->status);

    // Bind data
    $stmt->bindParam('treino_id', $this->treino_id);
    $stmt->bindParam('exercicio_id', $this->exercicio_id);
    $stmt->bindParam('series', $this->series);
    $stmt->bindParam('repeticoes', $this->repeticoes);
    $stmt->bindParam('status', $this->status);

    // Execute query
    if ($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
  }

  // Update Treino
  public function update()
  {


    // Create Query
    $query = 'UPDATE ' .
      $this->table . '
    SET
      treino_id      = :treino_id,
      exercicio_id = :exercicio_id,
      series    = :series,
      repeticoes = :repeticoes,
      status = :status
      WHERE
      id = :id';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->treino_id   = (int)htmlspecialchars($this->treino_id);
    $this->exercicio_id  = (int)htmlspecialchars($this->exercicio_id);
    $this->series      = (int)htmlspecialchars($this->series);
    $this->repeticoes      = (int)htmlspecialchars($this->repeticoes);
    $this->status      = (int)htmlspecialchars($this->status);
    $this->id         = (int)htmlspecialchars($this->id);

    // Bind data
    $stmt->bindParam('treino_id', $this->treino_id);
    $stmt->bindParam('exercicio_id', $this->exercicio_id);
    $stmt->bindParam('series', $this->series);
    $stmt->bindParam('repeticoes', $this->repeticoes);
    $stmt->bindParam('status', $this->status);
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
    if (!$this->verificar_treino_ativo($this->treino_id)) {
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
    }
    else return false;


    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
  }


  //verificar se o treino está ativo para algum aluno
  private function verificar_treino_ativo($id)
  {

    $query = 'SELECT td.id from treinos t, treino_detalhes td WHERE t.ativo=0 and td.id= :id and t.id = td.treino_id';

    // Prepare statement
    $stmt = $this->conn->prepare($query);
    // Bind Data
    $stmt->bindParam('id', $id);

    // Execute query
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }
}
