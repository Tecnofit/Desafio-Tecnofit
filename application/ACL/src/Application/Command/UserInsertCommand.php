<?php

namespace ACL\Application\Command;

use ACL\Domain\Entity\UserEntity;
use ACL\Infrastructure\Repository\UserRepository;

final class UserInsertCommand
{
    private UserRepository $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function run (UserEntity $user): UserEntity
    {
        return $this->userRepository->insertUser($user);
    }
}