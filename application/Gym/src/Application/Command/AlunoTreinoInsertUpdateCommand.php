<?php

namespace Gym\Application\Command;

use DateTimeImmutable;
use Gym\Domain\Entity\AlunoTreinoEntity;
use Gym\Domain\Entity\AlunoTreinoExercicioCollection;
use Gym\Domain\Entity\AlunoTreinoExercicioEntity;
use Gym\Infrastructure\Repository\AlunoTreinoRepository;
use Gym\Infrastructure\Repository\TreinoRepository;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class AlunoTreinoInsertUpdateCommand
{
    private AlunoTreinoRepository $alunoTreinoRepository;
    private TreinoRepository $treinoRepository;

    public function __construct(
        AlunoTreinoRepository $alunoTreinoRepository,
        TreinoRepository $treinoRepository
    ) {
        $this->alunoTreinoRepository = $alunoTreinoRepository;
        $this->treinoRepository = $treinoRepository;
    }

    public function run (UuidInterface $usuarioId, UuidInterface $treinoId, DateTimeImmutable $expiracao): AlunoTreinoEntity
    {
        $exists = $this->alunoTreinoRepository->find(null, $usuarioId, null)->get(0);

        $exercicios = new AlunoTreinoExercicioCollection;
        $changedTreino = !$exists || $exists->getTreinoId() != $treinoId || $exists->getExpiracao() != $expiracao;

        if (!$changedTreino) {
            return $exists;
        }

        $treino = $this->treinoRepository->findTreinos($treinoId)->get(0);
        foreach ($treino->getExercicios()->getList() as $row) {
            $exercicios->append(new AlunoTreinoExercicioEntity(
                Uuid::uuid4(),
                $row->getId(),
                $row->getExercicioId(),
                null
            ));
        }

        if ($exists) {
            return $this->alunoTreinoRepository->update(
                $exists->getId(),
                $usuarioId,
                $treinoId,
                $expiracao,
                $changedTreino ? $exercicios : $exists->getExercicios()
            );
        }

        return $this->alunoTreinoRepository->insert($usuarioId, $treinoId, $expiracao, $exercicios);
    }
}