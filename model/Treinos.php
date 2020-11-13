<?php

class Treinos {

    private string $nome; // pra peito, para costas
    private int $cod;
    private $listaExercicios;//varios exercicios para peito, costa


    public function __construct()
    {
        $this->listaExercicios = array();
    }

    //GETTERS AND SETTERS
    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     * @return Treinos
     */
    public function setNome(string $nome): Treinos
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return int
     */
    public function getCod(): int
    {
        return $this->cod;
    }

    /**
     * @param int $cod
     * @return Treinos
     */
    public function setCod(int $cod): Treinos
    {
        $this->cod = $cod;
        return $this;
    }

    /**
     * @return Exercicios[]
     */
    public function getListaExercicios(): array
    {
        return $this->listaExercicios;
    }

    /**
     * @param Exercicios[] $listaExercicios
     * @return Treinos
     */
    public function setListaExercicios(array $listaExercicios): Treinos
    {
        $this->listaExercicios = $listaExercicios;
        return $this;
    }

}