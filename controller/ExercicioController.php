<?php

require "../model/Exercicios.php";

class ExercicioController {

    //Singleton Pattern, only one instance of class controller
    private static $instance;

    public $exercicio;

    public function cadastrarExercicio($nome, $cod, $repeticoes, $estado='criado')
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

    public function atualizarExercicio($nome, $cod, $codExercicio=0, $ativo=false)
    {
        if(isset($this->exercicio) || $this->exercicio->getCod() == $cod){
            //NAO ESTOU VERIFICANDO SE O VALOR É CORRETO, NULO OU VAZIO
            $this->exercicio->setNome($nome);
            $this->exercicio->setCodExercicio($codExercicio);
            if($codExercicio > 0 && $ativo == false)
                $this->exercicio->setAtivo(true);
            else
                $this->exercicio->setAtivo($ativo);
            return $this->exercicio;
        }else{
            return NULL;
        }
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