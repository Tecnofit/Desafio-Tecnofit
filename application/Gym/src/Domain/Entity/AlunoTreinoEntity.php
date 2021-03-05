<?php

namespace Gym\Domain\Entity;

use DateTimeImmutable;
use Ramsey\Uuid\UuidInterface;

final class AlunoTreinoEntity
{
    private UuidInterface $id;
    private UuidInterface $usuarioId;
    private UuidInterface $treinoId;
    private DateTimeImmutable $expiracao;
    private AlunoTreinoExercicioCollection $exercicios;

    public function __construct(
        UuidInterface $id,
        UuidInterface $usuarioId,
        UuidInterface $treinoId,
        DateTimeImmutable $expiracao,
        AlunoTreinoExercicioCollection $exercicios
    ) {
        $this->id = $id;
        $this->usuarioId = $usuarioId;
        $this->treinoId = $treinoId;
        $this->expiracao = $expiracao;
        $this->exercicios = $exercicios;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getUsuarioId(): UuidInterface
    {
        return $this->usuarioId;
    }

    public function getTreinoId(): UuidInterface
    {
        return $this->treinoId;
    }

    public function getExpiracao(): DateTimeImmutable
    {
        return $this->expiracao;
    }

    public function getExercicios(): AlunoTreinoExercicioCollection
    {
        return $this->exercicios;
    }
}