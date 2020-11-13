<?php

class Aluno {

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
     * @return Aluno
     */
    public function setNome(?string $nome): Aluno
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
     * @return Aluno
     */
    public function setCod(int $cod): Aluno
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
     * @return Aluno
     */
    public function setCodTreino(int $codTreino): Aluno
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
     * @return Aluno
     */
    public function setAtivo(bool $ativo): Aluno
    {
        $this->ativo = $ativo;
        return $this;
    }
}
