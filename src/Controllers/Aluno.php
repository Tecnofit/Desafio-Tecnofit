<?php
namespace Tecnofit\Controllers;

use Tecnofit\Models\AlunoModel;

class Aluno extends AlunoModel
{

    public function index() : array
    {
        return $this->getAllUsers();
    }


    public function edit($id) : array
    {
        if (!empty($id)) {
            return $this->getAlunoById($id);
        }
        return [];
    }


    public function update(array $aluno, int $id): void
    {
        $this->updateAluno($aluno, $id);
    }


    public function delete(int $aluno_id) : void
    {
        $this->deletarAluno($aluno_id);
    }


}