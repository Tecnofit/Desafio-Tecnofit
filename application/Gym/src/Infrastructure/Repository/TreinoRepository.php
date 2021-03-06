<?php

namespace Gym\Infrastructure\Repository;

use Gym\Domain\Entity\TreinoCollection;
use Gym\Domain\Entity\TreinoEntity;
use Gym\Domain\Entity\TreinoExercicioCollection;
use Gym\Domain\Entity\TreinoExercicioEntity;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Shared\Infrastructure\Exception\DataValidateException;
use Shared\Infrastructure\Repository\MongoDBRepository;

final class TreinoRepository extends MongoDBRepository
{
    public function insertTreino(TreinoEntity $treino): TreinoEntity
    {
        $existent = $this->database()->treinos->findOne([
            "nome" => $treino->getNome()
        ]);

        if ($existent) {
            throw new DataValidateException("Já existe um treino cadastrado com este nome");
        }

        $exercicios = [];
        foreach ($treino->getExercicios()->getList() as $row) {
            $exercicios[] = [
                "id" => (String) $row->getId(),
                "exercicioId" => (String) $row->getExercicioId(),
                "repeticoes" => $row->getRepeticoes()
            ];
        }

        $uid = Uuid::uuid4();
        $this->database()->treinos->insertOne([
            '_id' => (String) $uid,
            'nome' => $treino->getNome(),
            'descricao' => $treino->getDescricao(),
            'exercicios' => $exercicios
        ]);

        $treino->setId($uid);

        return $treino;
    }

    public function updatetTreino(TreinoEntity $treino): TreinoEntity
    {
        $existent = $this->database()->treinos->findOne([
            "_id" => (String) $treino->getId()
        ]);
            
        if (!$existent) {
            throw new DataValidateException("Não foi encontrado um treino com este id");
        }
            
        $existent = $this->database()->treinos->findOne([
            "nome" => $treino->getNome(),
            "_id" => [ '$ne' => (String) $treino->getId() ]
        ]);

        if ($existent) {
            throw new DataValidateException("Já existe outro treino cadastrado com este nome");
        }

        $exercicios = [];
        foreach ($treino->getExercicios()->getList() as $row) {
            $exercicios[] = [
                "id" => (String) $row->getId(),
                "exercicioId" => (String) $row->getExercicioId(),
                "repeticoes" => $row->getRepeticoes()
            ];
        }

        $updateResult = $this->database()->treinos->updateOne(
            [ '_id' => (String) $treino->getId() ],
            [
                '$set' => [
                    'nome' => $treino->getNome(),
                    'descricao' => $treino->getDescricao(),
                    'exercicios' => $exercicios
                ]
            ]
        );

        // printf("Matched %d document(s)\n", $updateResult->getMatchedCount());
        // printf("Modified %d document(s)\n", $updateResult->getModifiedCount());

        return $treino;
    }

    public function findTreinos(
        ?UuidInterface $treinoId = null,
        ?UuidInterface $exercicioId = null
    ): TreinoCollection {
        $filters = [];

        if ($treinoId) {
            $filters["_id"] = (String) $treinoId;
        }

        if ($exercicioId) {
            $filters["exercicios.exercicioId"] = (String) $exercicioId;
        }

        $results = $this->database()->treinos->find($filters);

        $collection = new TreinoCollection;    

        foreach ($results as $result) {
            $exercicios = new TreinoExercicioCollection;
            if ($result->exercicios) {
                foreach ($result->exercicios as $row) {
                    $exercicios->append(new TreinoExercicioEntity(
                        Uuid::fromString($row->id),
                        Uuid::fromString($row->exercicioId),
                        (int) $row->repeticoes
                    ));
                }
            }
            $collection->append(
                new TreinoEntity(
                    Uuid::fromString($result->_id),
                    $result->nome,
                    $result->descricao,
                    $exercicios
                )
            );
        }
        
        return $collection;        
    }
}