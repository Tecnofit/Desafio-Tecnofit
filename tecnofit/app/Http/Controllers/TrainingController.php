<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrainingHandleActiveFormRequest;
use App\Http\Requests\TrainingStoreUpdateFormRequest;
use App\Services\TrainingService;
use Illuminate\Http\Request;

class TrainingController extends Controller
{

    protected $service;

    public function __construct(TrainingService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainings = $this->service->getAllCustomersTraining();
        return view('dashboard.training.index', compact('trainings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = $this->service->getAllCustomers();
        $exercises = $this->service->getAllExercises();
        return view('dashboard.training.create', compact('customers', 'exercises'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TrainingStoreUpdateFormRequest $request)
    {
        return $this->service->store($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$training = $this->service->getCustomerTrainingByUserId($id)) {
            return redirect()->route('trainings.index')->with('error', 'Treino não encontrado!');
        }
        return view('dashboard.training.show', compact('training'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$training = $this->service->getCustomerTrainingByUserId($id)) {
            return redirect()->route('trainings.index')->with('error', 'Treino não encontrado!');
        }
        $exercises = $this->service->getAllExercises();
        return view('dashboard.training.edit', compact('training', 'exercises'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TrainingStoreUpdateFormRequest $request, $id)
    {
        return $this->service->update($id, $request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function handleActive(TrainingHandleActiveFormRequest $request)
    {
        return $this->service->handleTraining($request->all());
    }
}
