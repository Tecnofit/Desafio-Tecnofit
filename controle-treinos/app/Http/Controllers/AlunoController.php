<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function index()
    {
        $teste = '<h1>ale</h1>';
        return $teste;
    }

    public function create()
    {
        return view('alunos.create');
    }

    public function store()
    {

    }

    public function destroy()
    {
        
    }
}
