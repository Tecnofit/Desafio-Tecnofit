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


}