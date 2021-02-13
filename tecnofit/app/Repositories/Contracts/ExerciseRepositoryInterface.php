<?php

namespace App\Repositories\Contracts;

interface ExerciseRepositoryInterface extends AbstractRepositoryInterface
{
    public function deleteAllExercisesByTrainingId(int $id);

}
