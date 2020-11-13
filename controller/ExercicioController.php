<?php

require "../model/Exercicios.php";

class ExercicioController {

    //Singleton Pattern, only one instance of class controller
    private static $instance;

    public $exercicio;

    public function cadastrarExercicio($nome, $cod, $codTreino, $repeticoes, $estado='criado')
    {
        //verificar se já não existe o exercicio
        $this->exercicio = $this->pesquisarExercicio($cod);
        if(!isset($this->exercicio)){
            //cadastra o exercicio
            $this->exercicio = new Exercicios();
            $this->exercicio->setNome($nome);
            $this->exercicio->setCod($cod);
            $this->exercicio->setRepeticoes($repeticoes);
            $this->exercicio->setEstado($estado);

            $this->incluirNoTreino($codTreino, $this->exercicio);
        }
        return $this->exercicio;
    }

    public function pesquisarExercicio($cod)
    {
        if(isset($this->exercicio) && $this->exercicio->getCod() == $cod){
            return $this->exercicio;
        }else{
            return NULL;
        }
    }

    public function pesquisarPorTreino($codTreino)
    {
        if(isset($this->exercicio) && $this->exercicio->getCod() == $cod){
            return $this->exercicio;
        }else{
            return NULL;
        }
    }

    public function deletarExercicio($cod): ?bool
    {
        if(isset($this->exercicio) || $this->exercicio->getCod() == $cod){
            $this->exercicio = NULL;
            return true;//DELETADO
        }else{
            return false;//NAO ENCONTRADO
        }
    }

    public function atualizarExercicio($nome, $cod, $codTreino, $repeticoes, $estado='criado')
    {
        if(isset($this->exercicio) || $this->exercicio->getCod() == $cod){

            $this->exercicio->setNome($nome);
            $this->exercicio->setRepeticoes($repeticoes);
            $this->exercicio->setEstado($estado);
            $this->exercicio->setCodTreino($codTreino);
            return $this->exercicio;
        }else{
            return NULL;
        }
    }

    public function incluirNoTreino($codTreino, $exercicio)
    {
        //require '../controller/TreinoController.php';
        $treinoCtl = TreinoController::getInstance();
        $treino = $treinoCtl->pesquisarTreino($codTreino);
        /*
         * Por questão de escopo, este código não verificar se já existe, remove ou deleta da lista
         * apenas insere o final
         * TODO removerExercicioNoTreino()
         * TODO isExercicioExiste()
         *
         */
        $treinoCtl->incluirExerciciosTreino($codTreino, $exercicio);

    }

    //Singleton Pattern
    public static function getInstance()
    {
        if(self::$instance === null){
            self::$instance = new self;
        }
        return self::$instance;
    }

}