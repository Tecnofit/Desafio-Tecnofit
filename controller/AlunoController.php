<?php

require "../model/Alunos.php";

class AlunoController {

    //Singleton Pattern, only one instance of class controller
    private static $instance;

    public $aluno;

    public function cadastrarAluno($nome, $cod, $codTreino=0, $ativo=false)
    {
        //verificar se já não existe o aluno
        $this->aluno = $this->pesquisarAluno($cod);
        if(!isset($this->aluno)){
            //cadastra o aluno
            $this->aluno = new Alunos();
            $this->aluno->setNome($nome);
            $this->aluno->setCod($cod);
            $this->aluno->setCodTreino($codTreino);
            $this->aluno->setAtivo($ativo);
        }
        return $this->aluno;
    }

    public function pesquisarAluno($cod)
    {
        if(isset($this->aluno) && $this->aluno->getCod() == $cod){
            return $this->aluno;
        }else{
            return NULL;
        }
    }

    public function deletarAluno($cod): ?bool
    {
        if(isset($this->aluno) || $this->aluno->getCod() == $cod){
            $this->aluno = NULL;
            return true;//DELETADO
        }else{
            return false;//NAO ENCONTRADO
        }
    }

    public function atualizarAluno($nome, $cod, $codTreino=0, $ativo=false)
    {
        if(isset($this->aluno) || $this->aluno->getCod() == $cod){
            //NAO ESTOU VERIFICANDO SE O VALOR É CORRETO, NULO OU VAZIO
            $this->aluno->setNome($nome);
            $this->aluno->setCodTreino($codTreino);
            if($codTreino > 0 && $ativo == false)
                $this->aluno->setAtivo(true);
            else
               $this->aluno->setAtivo($ativo);
            return $this->aluno;
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