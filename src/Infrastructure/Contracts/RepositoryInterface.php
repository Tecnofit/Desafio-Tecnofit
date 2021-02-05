<?php

namespace App\Infrastructure\Contracts;

use Ramsey\Uuid\UuidInterface;

/**
 * Interface RepositoryInterface
 *
 * @package App\Infrastructure\Contracts
 */
interface RepositoryInterface
{
    public static function getById(int $id);

    public static function getByUuId(UuidInterface $uuid);

    public static function save(ViewInterface $view);
}
