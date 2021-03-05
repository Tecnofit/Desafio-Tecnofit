<?php

namespace ACL\Infrastructure\Repository;

use ACL\Domain\Entity\UserCollection;
use ACL\Domain\Entity\UserEntity;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Shared\Domain\Value\EmailValue;
use Shared\Domain\Value\SenhaValue;
use Shared\Domain\Value\UsuarioPerfilValue;
use Shared\Infrastructure\Exception\DataValidateException;
use Shared\Infrastructure\Repository\MongoDBRepository;

final class UserRepository extends MongoDBRepository
{
    public function insertUser(UserEntity $user): UserEntity
    {
        $existent = $this->database()->users->findOne([
            "email" => $user->getEmail()->getValue()
        ]);

        if ($existent) {
            throw new DataValidateException("Já existe um usuário cadastrado para este e-mail");
        }

        $uid = Uuid::uuid4();
        $this->database()->users->insertOne([
            '_id' => (String) $uid,
            'nome' => $user->getNome(),
            'email' => $user->getEmail()->getValue(),
            'senha' => $user->getSenha()->getValue(),
            'perfil' => $user->getPerfil()->getValue(),
        ]);

        $user->setId($uid);

        return $user;
    }

    public function updatetUser(UserEntity $user): UserEntity
    {
        $existent = $this->database()->users->findOne([
            "_id" => (String) $user->getId()
        ]);
            
        if (!$existent) {
            throw new DataValidateException("Não foi encontrado um usuário com este id");
        }
            
        $existent = $this->database()->users->findOne([
            "email" => $user->getEmail()->getValue(),
            "_id" => [ '$ne' => (String) $user->getId() ]
        ]);

        if ($existent) {
            throw new DataValidateException("Já existe outro usuário cadastrado para este e-mail");
        }

        $updateResult = $this->database()->users->updateOne(
            [ '_id' => (String) $user->getId() ],
            [
                '$set' => [
                    'nome' => $user->getNome(),
                    'email' => $user->getEmail()->getValue(),
                    'senha' => $user->getSenha()->getValue(),
                    'perfil' => $user->getPerfil()->getValue(),
                ]
            ]
        );

        // printf("Matched %d document(s)\n", $updateResult->getMatchedCount());
        // printf("Modified %d document(s)\n", $updateResult->getModifiedCount());

        return $user;
    }

    public function remove(UuidInterface $userId): bool
    {
        $this->database()->users->deleteOne([
            '_id' => (String) $userId
        ]);

        return true;
    }


    public function findUsers(
        ?UuidInterface $userId = null,
        ?EmailValue $email = null
    ): UserCollection {
        $filters = [];
        
        if ($userId) {
            $filters["_id"] = (String) $userId;
        }

        if ($email) {
            $filters["email"] = $email->getValue();
        }

        $results = $this->database()->users->find($filters);

        $collection = new UserCollection;    

        foreach ($results as $result) {
            $collection->append(
                new UserEntity(
                    Uuid::fromString($result->_id),
                    $result->nome,
                    new EmailValue($result->email),
                    new SenhaValue($result->senha),
                    new UsuarioPerfilValue($result->perfil)
                )
            );
        }
        
        return $collection;        
    }
}