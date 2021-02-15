<?php

namespace App\Repositories\Eloquent;

use App\Models\Training;
use App\Models\User;
use App\Repositories\Contracts\TrainingRepositoryInterface;
use Illuminate\Support\Facades\DB;

class TrainingRepository extends AbstractRepository implements TrainingRepositoryInterface
{
    protected $model;

    public function __construct(Training $training)
    {
        $this->model = $training;
    }

    public function exerciseIsActiveInTraining(int $exercise_id)
    {
        return $this->model->where('exercise_id', $exercise_id)->where('active', true)->exists();
    }

    public function userHasAnActiveTraining(int $user_id)
    {
        return $this->model->where('user_id', $user_id)->where('active', true)->exists();
    }

    public function getAllCustomersTraining()
    {
        return DB::table('users as u')
            ->select('u.*', 't.id as training_id', 't.active')
            ->leftjoin('trainings as t', 't.id', '=', DB::raw("(SELECT MIN(t.id) FROM trainings as t WHERE t.user_id = u.id)"))
            ->where('u.role', 'customer')
            ->get();
    }

    public function getCustomerTrainingByUserId(int $id)
    {
        return User::with('trainings')->with('trainings.exercises')->where('users.role', 'customer')->where('users.id', $id)->first();
    }

    public function handleTrainingStatusById(int $id, string $status)
    {
        return $this->model->where('id', $id)->update(['status' => $status]);
    }

    public function handleTrainingActiveByUserId(int $user_id, bool $active)
    {
        return $this->model->where('user_id', $user_id)->update(['active' => $active]);
    }

    public function deleteAllExercisesByUserId(int $id)
    {
        return $this->model->where('user_id', $id)->delete();
    }
}
