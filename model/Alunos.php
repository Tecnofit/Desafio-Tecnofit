<?php

class Alunos {

    private string $nome;
    private int $cod;
    private int $codTreino;
    private bool $ativo; //treino ativo ou desativado

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

    /**
     * @return int
     */
    public function getCodTreino(): int
    {
        return $this->codTreino;
    }

    /**
     * @param int $codTreino
     * @return Alunos
     */
    public function setCodTreino(int $codTreino): Alunos
    {
        $this->codTreino = $codTreino;
        return $this;
    }

    /**
     * @return bool
     */
    public function isAtivo(): bool
    {
        return $this->ativo;
    }

    /**
     * @param bool $ativo
     * @return Alunos
     */
    public function setAtivo(bool $ativo): Alunos
    {
        $this->ativo = $ativo;
        return $this;
    }
}
