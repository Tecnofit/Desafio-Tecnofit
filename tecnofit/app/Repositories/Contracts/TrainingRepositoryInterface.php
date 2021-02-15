<?php

namespace App\Repositories\Contracts;

interface TrainingRepositoryInterface extends AbstractRepositoryInterface
{
    public function getAllCustomersTraining();
    public function exerciseIsActiveInTraining(int $id);
    public function userHasAnActiveTraining(int $id);
    public function getCustomerTrainingByUserId(int $id);
    public function handleTrainingStatusById(int $id, string $status);
    public function deleteAllExercisesByUserId(int $id);
    public function handleTrainingActiveByUserId(int $user_id, bool $active);
}
