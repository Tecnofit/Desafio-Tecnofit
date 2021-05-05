<?php
namespace Tecnofit\Controllers;

use Tecnofit\Models\AlunoModel;

class Aluno extends AlunoModel
{
    public function index()
    {
        return $this->getAllUsers();
    }
}