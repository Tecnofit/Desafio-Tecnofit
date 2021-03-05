<?php

namespace Gym\Application\Command;

use Gym\Domain\Entity\TreinoEntity;
use Gym\Infrastructure\Repository\TreinoRepository;

final class TreinoUpdateCommand
{
    private TreinoRepository $treinoRepository;

    public function __construct(
        TreinoRepository $treinoRepository
    ) {
        $this->treinoRepository = $treinoRepository;
    }

    public function run (TreinoEntity $treino): TreinoEntity
    {
        return $this->treinoRepository->updatetTreino($treino);
    }
}