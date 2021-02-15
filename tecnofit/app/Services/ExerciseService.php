<?php

namespace App\Services;

use App\Repositories\Contracts\ExerciseRepositoryInterface;
use App\Repositories\Contracts\TrainingRepositoryInterface;

class ExerciseService
{
    protected $exerciseRepository;
    protected $trainingRepository;

    public function __construct(ExerciseRepositoryInterface $exerciseRepository, TrainingRepositoryInterface $trainingRepository)
    {
        $this->exerciseRepository = $exerciseRepository;
        $this->trainingRepository = $trainingRepository;
    }

    public function store(array $data)
    {
        if (!$this->exerciseRepository->create($data)) {
            return redirect()->back()->with('error', 'Falha ao cadastrar!');
        }

        return redirect()->route('exercises.index')->with('success', 'Cadastro realizado com sucesso!');
    }

    public function update(int $id, array $data)
    {
        if (!$this->exerciseRepository->find($id)) {
            return redirect()->route('exercises.index')->with('error', 'Exercicio não encontrado!');
        }

        if (!$this->exerciseRepository->update($id, $data)) {
            return redirect()->back()->with('error', 'Falha ao atualizar!');
        }

        return redirect()->route('exercises.index')->with('success', 'Atualizado com sucesso!');
    }

    public function delete(int $id)
    {
        if (!$exercise = $this->exerciseRepository->find($id)) {
            return redirect()->route('exercises.index')->with('error', 'Exercicio não encontrado!');
        }

        if ($this->trainingRepository->exerciseIsActiveInTraining($id)) {
            return redirect()->route('exercises.index')->with('error', 'Ops, este exercicio está ativo em um treinamento!');
        }

        $response = $this->exerciseRepository->delete($exercise);
        if ($response) {
            return redirect()->route('exercises.index')->with('success', 'Exercicio deletado com sucesso!');
        }
        return redirect()->back()->with('error', 'Falha ao deletar!');
    }
}
