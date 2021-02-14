<?php

namespace App\Repositories\Contracts;

interface TrainingRepositoryInterface extends AbstractRepositoryInterface
{
    public function getAllCustomersTraining();
    public function exerciseIsActiveInTraining(int $id);
    public function userHasAnActiveTraining(int $id);
    public function getCustomerTrainingByUserId(int $id);
    public function handleTrainingStatusByUserId(int $id, bool $active = true);
    public function deleteAllExercisesByUserId(int $id);
}
