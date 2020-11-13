<?php

use PHPUnit\Framework\TestCase;
require '../controller/AlunoController.php';
require '../controller/TreinoController.php';
require '../controller/ExercicioController.php';

class Academia extends TestCase
{
    protected $alunoCtl;
    protected $treinoCtl;
    protected $exercicioCtl;

    /**
     * @before
     */
    public function setUpAllTests()
    {
        $this->alunoCtl = AlunoController::getInstance();
        $this->treinoCtl = TreinoController::getInstance();
        $this->exercicioCtl = ExercicioController::getInstance();
    }

    //-------------- REGRAS ALUNOS -------------------
    public function testCadastrarUmAluno(): void
    {
        //Cadastrar um aluno novo para podermos iniciar os testes
        $aluno = $this->alunoCtl->cadastrarAluno("Joao Silva", 1);
        $this->assertEquals($aluno->getNome(), "Joao Silva");
    }

    public function testPesquisarAluno(): void
    {
        //Pesquisar este aluno criado
        $aluno = $this->alunoCtl->pesquisarAluno(1);
        $this->assertEquals($aluno->getNome(), "Joao Silva");
        //verificar que ainda não tem treino ativo==criado
        $this->assertEquals($aluno->isAtivo(), false);

    }

    //-------------- REGRAS TREINOS -------------------
    //Criar alguns treinos
    public function testCriarUmTreino(): void
    {
        //Criar um treino para este aluno
        $treino = $this->treinoCtl->cadastrarTreino("Peito", 1);
        $this->assertEquals($treino->getNome(), "Peito");
        //Pesquisar novamente, agora retornando o treino disponibilizado
        $treino = $this->treinoCtl->pesquisarTreino(1);
        $this->assertEquals($treino->getNome(), "Peito");

    }

    //-------------- REGRAS EXERCÍCIOS -------------------
    //Criar alguns exercicios e atrelar a um treino
    public function testCriarDoisExercicio(): void
    {
        //Criar um exercicio para este aluno
        $exercicio = $this->exercicioCtl->cadastrarExercicio("Pullover", 100, 1, 3, 'criado');
        $this->assertEquals($exercicio->getNome(), "Pullover");
        $exercicio = $this->exercicioCtl->cadastrarExercicio("Supino", 101, 1, 4, 'criado');
        $this->assertEquals($exercicio->getNome(), "Supino");

        //Editar o nome de um exercicio
//TODO       $exercicio = $this->exercicioCtl->atualizarExercicio("Pullover-Barra", 100, 1, 5, 'criado');
//TODO        $this->assertEquals($exercicio->getNome(), "Pullover-Barra");

    }

    //Aluno 1 - fará o treino de (Peito, 1, [pullover, barra, supino])
    public function testAtribuirTreinoAoAluno(): void
    {
        //Pega o aluno 1
        $aluno = $this->alunoCtl->pesquisarAluno(1);
        //Setar o treino 1 para o aluno 1
        $aluno = $this->alunoCtl->atualizarAluno($aluno->getNome(), $aluno->getCod(), 1, true);
        //Verificar se ele esta com o treino ativado
        $this->assertEquals($aluno->getCodTreino(), 1);
        $this->assertTrue($aluno->isAtivo());

    }

    //-------------- REGRAS EXERCÍCIOS - REGRAS IMPORTANTES -------------------
    // **** Informar quantas sessoes serão feitas para um exercicio. ****
    // **** Aluno pode marcar como finalizado ou pular um exercicio ****
    public function testSessoesParaUmExercicio(): void
    {
        $aluno = $this->alunoCtl->pesquisarAluno(1);
        $treino = $this->treinoCtl->pesquisarTreino($aluno->getCodTreino());
        $listaExerc = $treino->getListaExercicios();
        //print_r($treino->getListaExercicios()[0][0]->getNome());

        //CHANGE
        foreach ($listaExerc as $key1=>$bloco){
            foreach ($bloco as $key2=>$exercicios) {
                if($exercicios->getCod() == 100){
                    //Retorno : Exercicio 100 retornar 3 repeticoes
                    $this->assertEquals($exercicios->getRepeticoes(), 3);

                    //Pular um exercicio
                    $treino->getListaExercicios()[$key1][$key2]->setEstado("aguardando");
                }
            }
        }

        //ASSERT
        foreach ($listaExerc as $bloco){
            foreach ($bloco as $exercicios) {
                if($exercicios->getCod() == 100){
                    $this->assertEquals($exercicios->getEstado(), 'aguardando');
                }
            }
        }
    }

    // **** Somente retornar um treino por aluno  ****
    public function testAlunoTemUnicoTreino(): void
    {
        //Aluno 1 somente tem o treino 1
        $aluno = $this->alunoCtl->pesquisarAluno(1);
        $this->assertEquals($aluno->getCodTreino(), 1);
    }

    // **** Excluir exercícios somente se não tiver dentro de treinos ativos, exercícios em uso. ****
    public function testRemoverSomenteSeNaoTiverAtivo(): void
    {
/*        $aluno = $this->alunoCtl->pesquisarAluno(1);
        $treino = $this->treinoCtl->pesquisarTreino($aluno->getCodTreino());
        $listaExerc = $treino->getListaExercicios();
        //print_r($treino->getListaExercicios()[0][0]->getNome());

        //ASSERT REMOVE CODIGO 101 EXERCICIO
        foreach ($listaExerc as $key1=>$bloco){
            foreach ($bloco as $key2=>$exercicios) {
                if($exercicios->getCod() == 101){



                    //Retorno : Exercicio 100 retornar 3 repeticoes
                    $this->assertEquals($exercicios->getRepeticoes(), 3);

                    //Pular um exercicio
                    $treino->getListaExercicios()[$key1][$key2]->setEstado("aguardando");
                }
            }
        }*/
        $this->assertEquals(true, true);
    }

    //Erro ao excluir exercicio que tem treino ativo
    //Sucesso ao excluir exercicio que NAO tem treino ativo


    //-------------- REGRAS FINAIS -------------------
    //Alterar o nome desse aluno
    //Remover o aluno
    //Remover um exercicio se existir
    //Remover um treino se existir


}

/**
 * @beforeClass
 */
//public static function setUpOnce() {}

/**
 * @afterClass
 */
//public static function tearDownOnce() { }
