<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Training;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'total instrutores' => User::where('role', 'instructor')->get()->count(),
            'total clientes' => User::where('role', 'customers')->get()->count(),
            'exercicios' => Exercise::get()->count(),
            'treinos ativos' => Training::get()->count(),
        ];
        return view('dashboard.dashboard.app', compact('data'));
    }
}
