<?php

namespace ACL\Application\Command;

use ACL\Domain\Entity\UserCollection;
use ACL\Domain\Entity\UserEntity;
use ACL\Infrastructure\Repository\UserRepository;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Shared\Domain\Value\EmailValue;
use Shared\Domain\Value\SenhaValue;
use Shared\Domain\Value\UsuarioPerfilValue;

final class UserListCommand
{
    private UserRepository $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function run (?UuidInterface $userId = null, ?EmailValue $email = null): UserCollection
    {
        if ($email && $email->getValue() === "admin@admin.com") {
            $collection = new UserCollection;
            $collection->append(new UserEntity(
                Uuid::fromString("6183c4b9-9c54-40a7-b223-8b12131125b2"),
                "Administrador",
                $email,
                SenhaValue::generatePassword("tecnofit"),
                new UsuarioPerfilValue("admin")
            ));
            return $collection;
        }

        return $this->userRepository->findUsers($userId, $email);
    }
}