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
        $exercicio = new Exercicios();
        $exercicio->setNome($nome);
        $exercicio->setCod($cod);
        $exercicio->setCodTreino($codTreino);
        $exercicio->setRepeticoes($repeticoes);
        $exercicio->setEstado($estado);

        $treinoCtl = TreinoController::getInstance();
        $treinoCtl->atualizarExercicioNoTreino($exercicio);

        return $exercicio;
    }

    public function incluirNoTreino($exercicio)
    {
        /*
         * Por questão de escopo, este código não verificar se já existe, remove ou deleta da lista
         * apenas insere o final
         */
        $treinoCtl = TreinoController::getInstance();
        $treinoCtl->atualizarExercicioNoTreino($exercicio);

    }

    public function alterarStatusExercicio($cod, $status)
    {
        $this->exercicio = $this->pesquisarExercicio($cod);
        if(isset($this->exercicio)){
            $this->exercicio->setEstado($status);
        }
        return $this->exercicio;
    }

    public function removeUmExercicio($treino, $codExercicio)
    {
        $treinoCtl = TreinoController::getInstance();
        $listaAtual = $treino->getListaExercicios();

        //Remove aqui o exercicio e atualiza
        $posicao = -1;
        foreach ($listaAtual as $key1=>$bloco){
            foreach ($bloco as $key2=>$exercicios) {
                if($exercicios->getCod() == $codExercicio){
                    $posicao = $key2;
                }
            }
            if($posicao>=0)
                unset($listaAtual[$key1][$posicao]);
        }
        $treino = $treinoCtl->atualizarTreino($treino->getNome(), $treino->getCod(), $listaAtual);

        return $treino;
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