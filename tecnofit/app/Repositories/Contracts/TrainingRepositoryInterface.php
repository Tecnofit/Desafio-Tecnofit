<?php

namespace App\Repositories\Contracts;

interface TrainingRepositoryInterface extends AbstractRepositoryInterface
{
    public function getAllWorkoutPlan();
    public function getWorkoutPlanById(int $id);
}
