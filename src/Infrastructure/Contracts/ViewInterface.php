<?php

namespace App\Infrastructure\Contracts;

/**
 * Interface ViewInterface
 *
 * @package App\Infrastructure\Contracts
 */
interface ViewInterface
{
    public function getId(): int;

    public function serialize(): array;
}
