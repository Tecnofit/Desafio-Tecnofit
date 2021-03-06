<?php

namespace Gym\Infrastructure\Repository;

use DateTimeImmutable;
use Gym\Domain\Entity\AlunoTreinoCollection;
use Gym\Domain\Entity\AlunoTreinoEntity;
use Gym\Domain\Entity\AlunoTreinoExercicioCollection;
use Gym\Domain\Entity\AlunoTreinoExercicioEntity;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Shared\Infrastructure\Exception\DataValidateException;
use Shared\Infrastructure\Repository\MongoDBRepository;

final class AlunoTreinoRepository extends MongoDBRepository
{
    public function insert(
        UuidInterface $usuarioId,
        UuidInterface $treinoId,
        DateTimeImmutable $expiracao,
        AlunoTreinoExercicioCollection $exercicios
    ): AlunoTreinoEntity
    {
        $uid = Uuid::uuid4();
        $alunoTreino = new AlunoTreinoEntity (
            $uid,
            $usuarioId,
            $treinoId,
            $expiracao,
            $exercicios
        );

        $this->database()->aluno_treino->insertOne([
            '_id' => (String) $alunoTreino->getId(),
            'usuarioId' => (String) $alunoTreino->getUsuarioId(),
            'treinoId' => (String) $alunoTreino->getTreinoId(),
            'expiracao' => $alunoTreino->getExpiracao()->format("Y-m-d H:i:s"),
            'exercicios' => array_map(function (AlunoTreinoExercicioEntity $alunoExercicio) {
                return [
                    'id' => (String) $alunoExercicio->getId(),
                    'treinoExercicioId' => (String) $alunoExercicio->getTreinoExercicioId(),
                    'exercicioId' => (String) $alunoExercicio->getExercicioId(),
                    'executed' => $alunoExercicio->getExecuted(),
                ];
            }, $exercicios->getList())
        ]);

        return $alunoTreino;
    }

    public function update(
        UuidInterface $alunoTreinoId,
        UuidInterface $usuarioId,
        UuidInterface $treinoId,
        DateTimeImmutable $expiracao,
        AlunoTreinoExercicioCollection $exercicios
    ): AlunoTreinoEntity
    {
        $existent = $this->find($alunoTreinoId, null, null)->get(0);
            
        if (!$existent) {
            throw new DataValidateException("Não foi encontrado um treino com este id para o aluno");
        }

        $this->database()->aluno_treino->updateOne(
            [ '_id' => (String) $alunoTreinoId ],
            [
                '$set' => [
                    'usuarioId' => (String) $usuarioId,
                    'treinoId' => (String) $treinoId,
                    'expiracao' => $expiracao->format("Y-m-d H:i:s"),
                    'exercicios' => array_map(function (AlunoTreinoExercicioEntity $alunoExercicio) {
                        return [
                            'id' => (String) $alunoExercicio->getId(),
                            'treinoExercicioId' => (String) $alunoExercicio->getTreinoExercicioId(),
                            'exercicioId' => (String) $alunoExercicio->getExercicioId(),
                            'executed' => $alunoExercicio->getExecuted(),
                        ];
                    }, $exercicios->getList())
                ]
            ]
        );

        return new AlunoTreinoEntity(
            $alunoTreinoId,
            $usuarioId,
            $treinoId,
            $expiracao,
            new AlunoTreinoExercicioCollection
        );
    }

    public function find(
        ?UuidInterface $alunoTreinoId,
        ?UuidInterface $usuarioId,
        ?UuidInterface $treinoId
    ): AlunoTreinoCollection {
        $filters = [];

        if ($alunoTreinoId) {
            $filters["_id"] = (String) $alunoTreinoId;
        }

        if ($usuarioId) {
            $filters["usuarioId"] = (String) $usuarioId;
        }

        if ($treinoId) {
            $filters["treinoId"] = (String) $treinoId;
        }

        $results = $this->database()->aluno_treino->find($filters);

        $collection = new AlunoTreinoCollection;

        foreach ($results as $result) {
            $exercicios = new AlunoTreinoExercicioCollection;

            if ($result->exercicios) {
                foreach ($result->exercicios as $exercicio) {
                    $exercicios->append(new AlunoTreinoExercicioEntity(
                        Uuid::fromString($exercicio->id),
                        Uuid::fromString($exercicio->treinoExercicioId),
                        Uuid::fromString($exercicio->exercicioId),
                        $exercicio->executed
                    ));
                }
            }

            $collection->append(new AlunoTreinoEntity(
                Uuid::fromString($result->_id),
                Uuid::fromString($result->usuarioId),
                Uuid::fromString($result->treinoId),
                new DateTimeImmutable($result->expiracao),
                $exercicios
            ));
        }

        return  $collection;
    }
}