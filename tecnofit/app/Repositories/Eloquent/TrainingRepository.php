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
        return $this->model->with('user')->with('exercises')->get();
    }

    public function getWorkoutPlanById(int $id){
        return $this->model->where('id', $id)->with('user')->with('exercises')->first();
    }

    public function exerciseIsActiveInTraining(int $exercise_id)
    {
        return $this->model->where('exercise_id', $exercise_id)->where('active', true)->exists();
    }
}
