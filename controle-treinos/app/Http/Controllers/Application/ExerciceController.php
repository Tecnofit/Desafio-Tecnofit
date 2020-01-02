<?php

namespace App\Http\Controllers\Application;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exercice;
use App\Http\Controllers\API\API_ExerciceController;

class ExerciceController extends Controller
{
    public function __construct(API_ExerciceController $exerciceService)
    {
        $this->exerciceService = $exerciceService;
    }

    public function index()
    {
        $exercices = $this->exerciceService->index()->getData();

        return view('exercices.index', compact('exercices')); 
    }

    public function show(int $id)
    {
        $exercice = $this->exerciceService->show($id)->getData();

        return view('exercices.show', compact('exercice'));
    }

    public function create()
    {
        return view('exercices.create');
    }

    public function store(Request $request)
    {
        $this->exerciceService->store($request);

        return redirect("/exercices");
    }

    public function update(Request $request, int $id)
    {
        $exercice = $this->exerciceService->update($request, $id);

        return redirect("/exercices");
    }

    public function destroy(int $id)
    {
        $exercice = $this->exerciceService->destroy($id);

        return redirect()->route('show_exercices');
    }

}
