<?php

namespace App\Services;

use App\Repositories\Contracts\ExerciseRepositoryInterface;
use App\Repositories\Contracts\TrainingRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class TrainingService
{
    protected $exerciseRepository;
    protected $trainingRepository;
    protected $userRepository;

    public function __construct(TrainingRepositoryInterface $trainingRepository, ExerciseRepositoryInterface $exerciseRepository, UserRepositoryInterface $userRepository)
    {
        $this->trainingRepository = $trainingRepository;
        $this->exerciseRepository = $exerciseRepository;
        $this->userRepository = $userRepository;
    }

    public function store(array $data)
    {
        DB::beginTransaction();

        if ($this->trainingRepository->userHasAnActiveTraining($data['user_id'])) {
            return redirect()->back()->with('error', 'Este usuário já possui um treino ativo!');
        }

        $data['exercises'] = $this->validateAndPrepare($data['exercises'], $data['user_id']);
        if(count($data['exercises']) <= 0){
            return redirect()->back()->with('error', 'Selecione ao menos 1 exercicio!');
        }

        foreach ($data['exercises'] as $exercise) {
            if (!$this->trainingRepository->create($exercise)) {
                DB::rollback();
                return redirect()->back()->with('error', 'Falha ao cadastrar!');
            }
        }

        DB::commit();
        return redirect()->route('trainings.index')->with('success', 'Cadastro realizado com sucesso!');
    }

    public function update(int $id, array $data)
    {
        if (!$this->getCustomerTrainingByUserId($id)) {
            return redirect()->route('trainings.index')->with('error', 'Treino não encontrado!');
        }

        DB::beginTransaction();

        $this->trainingRepository->deleteAllExercisesByUserId($data['user_id']);
        $data['exercises'] = $this->validateAndPrepare($data['exercises'], $data['user_id']);
        if(count($data['exercises']) <= 0){
            return redirect()->back()->with('error', 'Selecione ao menos 1 exercicio!');
        }
        foreach ($data['exercises'] as $exercise) {
            if (!$this->trainingRepository->create($exercise)) {
                DB::rollback();
                return redirect()->back()->with('error', 'Falha ao atualizar!');
            }
        }

        DB::commit();
        return redirect()->route('trainings.index')->with('success', 'Atualizado com sucesso!');
    }

    public function getAllCustomers()
    {
        return $this->userRepository->findBy(['role' => 'customer']);
    }

    public function getAllExercises()
    {
        return $this->exerciseRepository->all();
    }

    public function getAllCustomersTraining()
    {
        return $this->trainingRepository->getAllCustomersTraining();
    }

    public function getCustomerTrainingByUserId(int $user_id)
    {
        return $this->trainingRepository->getCustomerTrainingByUserId($user_id);
    }

    public function handleTrainingStatusById(int $id, string $status)
    {
        if (!$this->trainingRepository->find($id)) {
            return redirect()->back()->with('error', 'Treino não encontrado!');
        }

        if (!$this->trainingRepository->handleTrainingStatusById($id, $status)) {
            return redirect()->back()->with('error', 'Falha ao atualizar!');
        }

        return redirect()->route('workout');
    }

    private function validateAndPrepare(array $arr, int $user_id)
    {
        $exercises = [];
        $defaultSessions = 1;
        foreach ($arr as $item) {
            if (!empty($item['exercise_id']) && is_numeric($item['exercise_id'])) {
                $sessions = is_numeric($item['sessions']) && $item['sessions'] > 0 ? $item['sessions'] : $defaultSessions;
                $exercises[] = ['exercise_id' => $item['exercise_id'], 'sessions' => $sessions, 'user_id' => $user_id];
            }
        }
        return $exercises;
    }

    public function handleTraining(array $arr)
    {
        if (!$this->getCustomerTrainingByUserId($arr['user_id'])) {
            return redirect()->back()->with('error', 'Treino não encontrado!');
        }
        $active = $arr['active'] ? false : true;
        if (!$this->trainingRepository->handleTrainingActiveByUserId($arr['user_id'], $active)) {
            return redirect()->back()->with('error', 'Falha ao atualizar!');
        }

        return redirect()->route('trainings.index')->with('success', 'Atualizado com sucesso!');
    }
}
