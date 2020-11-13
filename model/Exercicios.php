<?php

class Exercicios {

    private string $nome; //pullover, supino
    private int $cod;
    private int $codTreino;
    private int $repeticoes; //3 séries de 3 repeticoes
    private string $estado; //criado, encerrado ou aguardando

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
     * @return Exercicios
     */
    public function setNome(string $nome): Exercicios
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
     * @return Exercicios
     */
    public function setCod(int $cod): Exercicios
    {
        $this->cod = $cod;
        return $this;
    }
    /**
     * @return int
     */
    public function getCodTreino(): int
    {
        return $this->codTreino;
    }

    /**
     * @param int $codTreino
     * @return Exercicios
     */
    public function setCodTreino(int $codTreino): Exercicios
    {
        $this->codTreino = $codTreino;
        return $this;
    }

    /**
     * @return int
     */
    public function getRepeticoes(): int
    {
        return $this->repeticoes;
    }

    /**
     * @param int $repeticoes
     * @return Exercicios
     */
    public function setRepeticoes(int $repeticoes): Exercicios
    {
        $this->repeticoes = $repeticoes;
        return $this;
    }

    /**
     * @return string
     */
    public function getEstado(): string
    {
        return $this->estado;
    }

    /**
     * @param string $estado
     * @return Exercicios
     */
    public function setEstado(string $estado): Exercicios
    {
        $this->estado = $estado;
        return $this;
    }

}