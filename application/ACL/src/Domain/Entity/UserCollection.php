<?php

namespace ACL\Domain\Entity;

final class UserCollection
{
    /**
     * @var UserEntity[]
     */
    private array $items = [];

    public function __construct() {
        $this->items = [];
    }

    public function append (UserEntity $user): void
    {
        $this->items[] = $user;
    }

    /**
     * @return UserEntity[]
     */
    public function getList(): array
    {
        return $this->items;
    }
}