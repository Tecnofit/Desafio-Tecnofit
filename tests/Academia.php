<?php

use PHPUnit\Framework\TestCase;
require '../controller/AlunoController.php';
require '../controller/TreinoController.php';

class Academia extends TestCase
{
    protected $alunoCtl;
    protected $treinoCtl;

    /**
     * @before
     */
    public function setUpAllTests()
    {
        $this->alunoCtl = AlunoController::getInstance();
        $this->treinoCtl = TreinoController::getInstance();
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
        //Pesquisar este aluno criado e verificar que ainda não tem treino ativo
        $aluno = $this->alunoCtl->pesquisarAluno(1);
        $this->assertEquals($aluno->getNome(), "Joao Silva");

        //echo var_dump($aluno);
    }

    //-------------- REGRAS TREINOS -------------------
    //Criar alguns treinos
    public function testCriarUmTreino(): void
    {
        //Criar um treino para este aluno
        $treino = $this->treinoCtl->cadastrarTreino("Peito", 1, array());
        $this->assertEquals($treino->getNome(), "Peito");
        //Pesquisar novamente, agora retornando o treino disponibilizado
        $treino = $this->treinoCtl->pesquisarTreino(1);
        $this->assertEquals($treino->getNome(), "Peito");

        //echo var_dump($treino);
    }

    //-------------- REGRAS EXERCÍCIOS -------------------
    //Criar alguns exercicios e atrelar a um treino
        //Criar um treino para este aluno
        //Pesquisar novamente, agora retornando o treino disponibilizado

    //Pesquisar um exercicio recém criado
    //Editar o nome de um exercicio

    //Aluno 1 - fará o treino de (Peito, 1, [pullover, barra, supino])

    //-------------- REGRAS EXERCÍCIOS - REGRAS IMPORTANTES -------------------
    // **** Informar quantas sessoes serão feitas para um exercicio. ****
    //Retorno : Exercicio 100 retornar 3 repeticoes

    // **** Somente retornar um treino por aluno  ****
    //Erro Buscar um treino inexistente
    //Successo Buscar um treino existente

    // **** Marcar como finalizado ou pular um exercicio ****
    //Marcar como finalizado
    //Pular um exercicio

    // **** Excluir exercícios somente se não tiver dentro de treinos ativos, exercícios em uso. ****
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
