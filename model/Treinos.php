<?php

class Treinos {

    private string $nome; // pra peito, para costas
    private int $cod;
    private $codExercicios = array(); //varios exercicios para peito, costa

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
     * @return array
     */
    public function getCodExercicios(): array
    {
        return $this->codExercicios;
    }

    /**
     * @param array $codExercicios
     * @return Treinos
     */
    public function setCodExercicios(array $codExercicios): Treinos
    {
        //nao remove apenas um exercicio, altera todos
        $this->codExercicios = $codExercicios;
        return $this;
    }


}