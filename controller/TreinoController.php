<?php

require "../model/Treinos.php";

class TreinoController {

    //Singleton Pattern, only one instance of class controller
    private static $instance;

    public $treino;

    public function cadastrarTreino($nome, $cod, $codExercicios = array())
    {
        //verificar se já não existe o treino
        $this->treino = $this->pesquisarTreino($cod);
        if(!isset($this->treino)){
            //cadastra o treino
            $this->treino = new Treinos();
            $this->treino->setNome($nome);
            $this->treino->setCod($cod);
            $this->treino->setCodExercicios($codExercicios);
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

    public function atualizarTreino($nome, $cod, $codTreino=0, $ativo=false)
    {
        if(isset($this->treino) || $this->treino->getCod() == $cod){
            //NAO ESTOU VERIFICANDO SE O VALOR É CORRETO, NULO OU VAZIO
            $this->treino->setNome($nome);
            $this->treino->setCodTreino($codTreino);
            if($codTreino > 0 && $ativo == false)
                $this->treino->setAtivo(true);
            else
                $this->treino->setAtivo($ativo);
            return $this->treino;
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