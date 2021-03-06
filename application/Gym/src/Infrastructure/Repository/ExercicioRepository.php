<?php

namespace Gym\Infrastructure\Repository;

use Gym\Domain\Entity\ExercicioCollection;
use Gym\Domain\Entity\ExercicioEntity;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Shared\Infrastructure\Exception\DataValidateException;
use Shared\Infrastructure\Repository\MongoDBRepository;

final class ExercicioRepository extends MongoDBRepository
{
    public function insertExercicio(ExercicioEntity $exercicio): ExercicioEntity
    {
        $existent = $this->database()->exercicios->findOne([
            "nome" => $exercicio->getNome()
        ]);

        if ($existent) {
            throw new DataValidateException("Já existe um exercício cadastrado com este nome");
        }

        $uid = Uuid::uuid4();
        $this->database()->exercicios->insertOne([
            '_id' => (String) $uid,
            'nome' => $exercicio->getNome(),
            'descricao' => $exercicio->getDescricao()
        ]);

        $exercicio->setId($uid);

        return $exercicio;
    }

    public function updatetUser(ExercicioEntity $exercicio): ExercicioEntity
    {
        $existent = $this->database()->exercicios->findOne([
            "_id" => (String) $exercicio->getId()
        ]);
            
        if (!$existent) {
            throw new DataValidateException("Não foi encontrado um exercício com este id");
        }
            
        $existent = $this->database()->exercicios->findOne([
            "nome" => $exercicio->getNome(),
            "_id" => [ '$ne' => (String) $exercicio->getId() ]
        ]);

        if ($existent) {
            throw new DataValidateException("Já existe outro exercício cadastrado com este nome");
        }

        $updateResult = $this->database()->exercicios->updateOne(
            [ '_id' => (String) $exercicio->getId() ],
            [
                '$set' => [
                    'nome' => $exercicio->getNome(),
                    'descricao' => $exercicio->getDescricao()
                ]
            ]
        );

        // printf("Matched %d document(s)\n", $updateResult->getMatchedCount());
        // printf("Modified %d document(s)\n", $updateResult->getModifiedCount());

        return $exercicio;
    }

    public function remove(UuidInterface $userId): bool
    {
        $this->database()->exercicios->deleteOne([
            '_id' => (String) $userId
        ]);

        return true;
    }

    public function findExercicios(
        ?UuidInterface $exercicioId = null
    ): ExercicioCollection {
        $filters = [];

        if ($exercicioId) {
            $filters["_id"] = (String) $exercicioId;
        }

        $results = $this->database()->exercicios->find($filters);

        $collection = new ExercicioCollection;    

        foreach ($results as $result) {
            $collection->append(
                new ExercicioEntity(
                    Uuid::fromString($result->_id),
                    $result->nome,
                    $result->descricao
                )
            );
        }
        
        return $collection;        
    }
}