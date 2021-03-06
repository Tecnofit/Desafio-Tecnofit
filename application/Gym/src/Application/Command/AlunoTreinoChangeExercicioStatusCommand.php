<?php

namespace Gym\Application\Command;

use Gym\Domain\Entity\AlunoTreinoEntity;
use Gym\Infrastructure\Repository\AlunoTreinoRepository;
use Ramsey\Uuid\UuidInterface;
use Shared\Infrastructure\Exception\DataValidateException;

final class AlunoTreinoChangeExercicioStatusCommand
{
    private AlunoTreinoRepository $alunoTreinoRepository;

    public function __construct (
        AlunoTreinoRepository $alunoTreinoRepository
    ) {
        $this->alunoTreinoRepository = $alunoTreinoRepository;
    }

    public function run (
        UuidInterface $usuarioId,
        UuidInterface $alunoTreinoId,
        UuidInterface $alunoTreinoExercicioId,
        bool $executado
    ): AlunoTreinoEntity {

        $alunoTreino = $this->alunoTreinoRepository->find($alunoTreinoId, $usuarioId, null)->get(0);

        if (!$alunoTreino) {
            throw new DataValidateException("Não foi encontrado este treino para o usuário");
        }

        $found = null;
        foreach ($alunoTreino->getExercicios()->getList() as $alunoTreinoExercicio) {
            if ((String) $alunoTreinoExercicio->getTreinoExercicioId() === (String) $alunoTreinoExercicioId) {
                $found = $alunoTreinoExercicio;
                $alunoTreinoExercicio->setExecuted($executado);
            }
        }

        if (!$found) {
            throw new DataValidateException("Não foi encontrado este exercício para o usuário");
        }

        $this->alunoTreinoRepository->update(
            $alunoTreino->getId(),
            $alunoTreino->getUsuarioId(),
            $alunoTreino->getTreinoId(),
            $alunoTreino->getExpiracao(),
            $alunoTreino->getExercicios()
        );

        return $alunoTreino;
    }
}