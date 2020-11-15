<?php

class Alunos {

    private int $cod;
    private string $nome;

    //GETTERS AND SETTERS
    /**
     * @return string|null
     */
    public function getNome(): ?string
    {
        return $this->nome;
    }

    /**
     * @param string|null $nome
     * @return Alunos
     */
    public function setNome(?string $nome): Alunos
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
     * @return Alunos
     */
    public function setCod(int $cod): Alunos
    {
        $this->cod = $cod;
        return $this;
    }

}
