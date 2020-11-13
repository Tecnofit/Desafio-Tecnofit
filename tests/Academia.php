<?php

use PHPUnit\Framework\TestCase;

class Academia extends TestCase
{
    /**
     * @before
     */
    public function setUpAllTests()
    {

    }

    //-------------- REGRAS ALUNOS -------------------
        //Cadastrar um aluno novo para podermos iniciar os testes
        //Pesquisar este aluno criado e verificar que ainda não tem treino ativo


    //-------------- REGRAS TREINOS -------------------
    //Criar alguns treinos
        //Criar um treino para este aluno
        //Pesquisar novamente, agora retornando o treino disponibilizado

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
