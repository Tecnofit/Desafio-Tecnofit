<?php

namespace App\Services;

use App\Repositories\Contracts\ExerciseRepositoryInterface;
use App\Repositories\Contracts\TrainingRepositoryInterface;
use Illuminate\Support\Facades\DB;

class TrainingService
{
    protected $exerciseRepository;
    protected $trainingRepository;

    public function __construct(TrainingRepositoryInterface $trainingRepository, ExerciseRepositoryInterface $exerciseRepository)
    {
        $this->trainingRepository = $trainingRepository;
        $this->exerciseRepository = $exerciseRepository;
    }

    public function store(array $data)
    {
        DB::beginTransaction();

        //Store a new training
        $training = $this->trainingRepository->create($data);
        $exercises = true;

        //Prepare Exercises if exists in request
        if (!empty($data['exercises'])) {
            $data['exercises'] = $this->prepareExercises($data['exercises'], $training->id);
            $exercises = $this->exerciseRepository->insert($data['exercises']);
        }

        //Validate all operations before commit
        if ($training && $exercises) {
            DB::commit();
            return redirect()->route('trainings.index')->with('success', 'Cadastro realizado com sucesso!');
        }

        DB::rollback();
        return redirect()->back()->with('error', 'Falha ao cadastrar!');
    }

    public function update(int $id, array $data)
    {
        if (!$training = $this->trainingRepository->find($id)) {
            return redirect()->route('trainings.index')->with('error', 'Treino não encontrado!');
        }

        DB::beginTransaction();

        $training = $this->trainingRepository->update($id, $data);
        $deletedExercises = $this->exerciseRepository->deleteAllExercisesByTrainingId($training->id);
        $exercises = true;
        //Prepare Exercises if exists in request
        if (!empty($data['exercises'])) {
            $data['exercises'] = $this->prepareExercises($data['exercises'], $training->id);
            $exercises = $this->exerciseRepository->insert($data['exercises']);
        }

        //Validate all operations before commit
        if ($training && $deletedExercises && $exercises) {
            DB::commit();
            return redirect()->route('trainings.index')->with('success', 'Atualizado com sucesso!');
        }

        DB::rollback();
        return redirect()->back()->with('error', 'Falha ao atualizar!');
    }

    public function delete(int $id)
    {
        if (!$training = $this->trainingRepository->find($id)) {
            return redirect()->route('trainings.index')->with('error', 'Treino não encontrado!');
        }

        $response = $this->trainingRepository->delete($training);
        if ($response) {
            return redirect()->route('trainings.index')->with('success', 'Deletado com sucesso!');
        }
        return redirect()->back()->with('error', 'Falha ao deletar!');
    }

    private function prepareExercises(array $arr, int $training_id)
    {
        $exercises = [];
        foreach ($arr as $item) {
            if (is_string($item['name']) && is_numeric($item['sessions'])) {
                $exercises[] = array_merge($item, ['training_id' => $training_id]);
            }
        }
        return $exercises;
    }
}
