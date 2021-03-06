<?php

namespace Gym\Application\Command;

use Gym\Domain\Entity\TreinoCollection;
use Gym\Infrastructure\Repository\TreinoRepository;
use Ramsey\Uuid\UuidInterface;

final class TreinoListCommand
{
    private TreinoRepository $treinoRepository;

    public function __construct(
        TreinoRepository $treinoRepository
    ) {
        $this->treinoRepository = $treinoRepository;
    }

    public function run (
        ?UuidInterface $treinoId = null
    ): TreinoCollection {
        return $this->treinoRepository->findTreinos($treinoId);
    }
}