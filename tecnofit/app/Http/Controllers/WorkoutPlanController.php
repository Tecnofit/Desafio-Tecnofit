<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkoutFormRequest;
use App\Services\TrainingService;
use Illuminate\Http\Request;

class WorkoutPlanController extends Controller
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
        $training = $this->service->getCustomerTrainingByUserId(auth()->user()->id);
        return view('workoutPlan.index', compact('training'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function skip(WorkoutFormRequest $request)
    {
        $id = $request->get('id');
        return $this->service->handleTrainingStatusById($id, 'skipped');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function completed(WorkoutFormRequest $request)
    {
        $id = $request->get('id');
        return $this->service->handleTrainingStatusById($id, 'completed');
    }
}
