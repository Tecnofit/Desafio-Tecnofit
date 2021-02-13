<?php

namespace App\Repositories\Eloquent;

use App\Models\Training;
use App\Repositories\Contracts\TrainingRepositoryInterface;

class TrainingRepository extends AbstractRepository implements TrainingRepositoryInterface
{
    protected $model;

    public function __construct(Training $training)
    {
        $this->model = $training;
    }

    public function getAllWorkoutPlan(){
        return Training::with('user')->with('exercises')->get();
    }

    public function getWorkoutPlanById(int $id){
        return Training::where('id', $id)->with('user')->with('exercises')->first();
    }
}
