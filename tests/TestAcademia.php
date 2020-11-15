<?php

use PHPUnit\Framework\TestCase;

require '../controller/AlunoController.php';
require '../controller/TreinoController.php';
require '../controller/ExercicioController.php';
require "../persistence/Connection.php";

class TestAcademia extends TestCase
{
    private $alunoCtl;
    private $treinoCtl;
    private $exercicioCtl;
    private $conn;

    /**
     * @before
     */
    public function setUpEveryTests()
    {
        $this->conn = Connection::getInstance()->getConnection();
        $this->alunoCtl = AlunoController::getInstance();
        $this->treinoCtl = TreinoController::getInstance();
        $this->exercicioCtl = ExercicioController::getInstance();
    }

    /**
     * @beforeClass
     */
    public function setUpAllBeforeClass(): void
    {
    }

    /**
     * @afterClass
     */
    public function tearDownAllAfterClass(): void
    {
        $this->conn->close();
    }

    public function testConnectionDatabase(): void
    {
        $result = $this->conn->query("SELECT * FROM aluno LIMIT 10");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                //echo $result->num_rows . ' ' . $row['nome'];
                $this->assertNotEmpty($row['nome']);
                $this->assertGreaterThan(0, $result->num_rows);
            }
        } else {
            $this->assertEquals(0, $result->num_rows);
        }
    }

    //-------------- REGRAS TREINOS -------------------
    public function testTreinoCRUD(): void
    {
        //Pesquisar e remover antes se já existir para testar a funcionaliade cadastro
        //Passa um código que nao se pode mudar devido as ligacaoes com aluno e exercicios
        $id = $this->treinoCtl->pesquisar("Peito");
        if ($id != null) {
            //Existe Alunos ou Exercicios cadastrados não se pode remover
            $removeu = $this->treinoCtl->remover("Peito");
            if ($removeu) {
                $id = $this->treinoCtl->cadastrar($id['cod'], "Peito");
                $this->assertGreaterThan(0, $id);
            } else {
                //Tem treinamento ativo, nao se pode remover
                //Realizar outra rotina para excluir primeiro o treinamento
                $this->assertFalse($removeu);
            }
            $this->assertFalse($removeu);//Nao pode remover
        } else {
            $id = $this->treinoCtl->cadastrar(1, "Peito");
            $this->assertGreaterThan(0, $id);
        }
    }

    //-------------- REGRAS EXERCICIOS -------------------
    // **** Excluir exercícios somente se não tiver dentro de treinos ativos, exercícios em uso. ****
    public function testExercicioCRUD(): void
    {
        //Pesquisar e remover antes se já existir para testar a funcionaliade cadastro
        $id = $this->exercicioCtl->pesquisar("Pullover");
        if ($id != null) {
            //ao remover e adicionar o id muda
            $removeu = $this->exercicioCtl->remover("Pullover");
            if ($removeu) {
                $id = $this->exercicioCtl->cadastrar($id['cod'], "Pullover", 1, 3);
                $this->assertGreaterThan(0, $id);
            } else {
                //Tem treinamento ativo, nao se pode remover
                //Realizar outra rotina para excluir primeiro o treinamento
                $this->assertFalse($removeu);
            }
        } else {
            $id = $this->exercicioCtl->cadastrar(NULL, "Pullover", 1, 3);
            $this->assertGreaterThan(0, $id);
        }
    }

    //-------------- REGRAS ALUNOS -------------------
    public function testAlunoCRUD(): void
    {
        //Pesquisar e remover antes se já existir para testar a funcionaliade cadastro
        $id = $this->alunoCtl->pesquisar("Joe");
        if ($id != null) {//aluno ja cadastrado
            $removeu = $this->alunoCtl->remover("Joe");
            if ($removeu) {
                $id = $this->alunoCtl->cadastrar("Joe");
                $this->assertGreaterThan(0, $id);
            } else {
                //Tem treinamento ativo, nao se pode remover
                //Realizar outra rotina para excluir primeiro o treinamento
                $this->assertFalse($removeu);
            }
        } else {//aluno novo
            $id = $this->alunoCtl->cadastrar("Joe");
            $this->assertGreaterThan(0, $id);
        }
    }

    //====================================================================================
    //Aluno 1 - fará o treino de (Peito, 1, [pullover, barra, supino])
    public function testAtribuirTreinoAoAluno(): void
    {
        //Pesquisar o Aluno, Pesquisar o treino se existir atribui-lo
        $id = $this->alunoCtl->pesquisar("Joe");
        if ($id != null) {
            $exercicio = 1;//Pullover
            $atualizou = $this->treinoCtl->atualizarTreinamento($id['cod'], $exercicio, 'finalizado');
            $this->assertTrue($atualizou);
        }

    }

    //-------------- REGRAS EXERCÍCIOS - REGRAS IMPORTANTES -------------------
    // **** Informar quantas sessoes serão feitas para um exercicio. ****
    public function testAlunoQuantasRepeticoes(): void
    {
        //Pesquisar o Aluno, Pesquisar o treino, Pesquisar os exercícios dele
        $aid = $this->alunoCtl->pesquisar("Joe");
        if ($aid != null) {
            $tid = $this->treinoCtl->pesquisarTreinamento($aid['cod']);
            foreach ($tid as $key1 => $item) {
                $eid = $this->exercicioCtl->pesquisarPorCodigo($tid['codExercicio']);
                if ($eid != null) {
                    foreach ($eid as $key2 => $item2) {
                        if ($eid[$key2][0] == $tid['codExercicio']) {
                            $this->assertEquals($eid[$key2][1], 'Pullover');    //NOME DO EXERCICIO
                            $this->assertEquals($eid[$key2][2], 1);     //TREINO 1 PEITO
                            $this->assertEquals($eid[$key2][3], 5);     //3 SESSOES REPETICOES
                            $this->assertEquals($eid[$key2][4], 'criado');  //CRIADO OU SEJA DISPONIVEL
                        }
                    }
                }
            }
        }
    }

    // **** Aluno pode marcar como finalizado ou pular um exercicio ****
    public function testExercicioFinalizado(): void
    {
        //Pesquisar o Aluno, Pesquisar o treino, Pesquisar os exercícios dele
        $aid = $this->alunoCtl->pesquisar("Joe");
        if ($aid != null) {
            //OK O ALUNO TEM O EXERCICIO NO TREINO DELE
            $exercicio = 1;
            $id = $this->treinoCtl->atualizarTreinamento($aid['cod'], 1, 'finalizado');
            $this->assertTrue($id);
        }
    }

    // **** Somente retornar um treino por aluno  ****
    public function testAlunoTemUnicoTreino(): void
    {
        $count = 0;
        $aid = $this->alunoCtl->pesquisar("Joe");
        if ($aid != null) {
            foreach ($aid as $key => $item) {
                $tid = $this->treinoCtl->pesquisarTreinamento($aid['cod']);
                $count++;
                break;
            }
        }
        $this->assertLessThanOrEqual(1, $count);
    }

}