<?php

declare(strict_types=1);

namespace App\Infrastructure;

use Exception;
use DateTime;
use Ramsey\Uuid\UuidInterface;
use App\Infrastructure\Contracts\ViewInterface;

/**
 * Class ViewAbstract
 *
 * @package App\Infrastructure\Abstracts
 */
abstract class View implements ViewInterface
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var UuidInterface
     */
    protected $uuid;

    /**
     * @var DateTime|null
     */
    protected $createdAt;

    /**
     * @var DateTime|null
     */
    protected $updatedAt;

    /**
     * @var DateTime|null
     */
    protected $deletedAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id ?: 0;
    }

    /**
     * @param int $id
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return UuidInterface|null
     */
    public function getUuid(): ?UuidInterface
    {
        return $this->uuid;
    }

    /**
     * @param UuidInterface|null $uuid
     * @return void
     */
    public function setUuid(?UuidInterface $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * @return DateTime|null
     */
    public function getCreatedDateAt(): ?DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(?DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime|null $updatedAt
     */
    public function setUpdatedAt(?DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return DateTime|null
     */
    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    /**
     * @param DateTime|null $deletedAt
     */
    public function setDeletedAt(?DateTime $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }

    /**
     * @param array $params
     * @return void
     * @throws Exception
     */
    public static function fromArray(array $params)
    {
        throw new Exception("method_not_implemented");
    }
}
