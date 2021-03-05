<?php

namespace ACL\Application\Command;

use ACL\Domain\Entity\UserEntity;
use ACL\Infrastructure\Repository\UserRepository;
use Ramsey\Uuid\UuidInterface;

final class UserRemoveCommand
{
    private UserRepository $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function run (UuidInterface $userId): bool
    {
        return $this->userRepository->remove($userId);
    }
}