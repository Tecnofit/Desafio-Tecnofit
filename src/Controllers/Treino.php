<?php

namespace Tecnofit\Controllers;

use Tecnofit\Models\TreinoModel;

class Treino extends TreinoModel
{
    public function index() : array
    {
        return $this->getAllTreinos();
    }
}