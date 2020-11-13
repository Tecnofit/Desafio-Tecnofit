<?php

require "../model/Treinos.php";

class TreinoController {

    //Singleton Pattern, only one instance of class controller
    private static $instance;

    public $treino;

    public function cadastrarTreino($nome, $cod)
    {
        //verificar se já não existe o treino
        $this->treino = $this->pesquisarTreino($cod);
        if(!isset($this->treino)){
            //cadastra o treino
            $this->treino = new Treinos();
            $this->treino->setNome($nome);
            $this->treino->setCod($cod);
        }
        return $this->treino;
    }

    public function pesquisarTreino($cod)
    {
        if(isset($this->treino) && $this->treino->getCod() == $cod){
            return $this->treino;
        }else{
            return NULL;
        }
    }

    public function deletarTreino($cod): ?bool
    {
        if(isset($this->treino) || $this->treino->getCod() == $cod){
            $this->treino = NULL;
            return true;//DELETADO
        }else{
            return false;//NAO ENCONTRADO
        }
    }

    public function atualizarTreino($nome, $codTreino, $listaExercicios = array())
    {
        if(isset($this->treino) || $this->treino->getCod() == $codTreino){
            //NAO ESTOU VERIFICANDO SE O VALOR É CORRETO, NULO OU VAZIO
            $this->treino->setNome($nome);
            $this->treino->setCod($codTreino);
            $this->treino->setListaExercicios($listaExercicios);
            return $this->treino;
        }else{
            return NULL;
        }
    }


    public function incluirExerciciosTreino($codTreino, $exercicio)
    {
        if (isset($this->treino) || $this->treino->getCod() == $codTreino) {
            //Só vai adicionando ao final, não remove, nem checa 't o d o' futuro

            $lista = $this->treino->getListaExercicios();
            array_push($lista, array($exercicio));
            $this->treino->setListaExercicios($lista);
            return $this->treino;
        } else {
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