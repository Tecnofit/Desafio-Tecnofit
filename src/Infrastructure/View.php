<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Infrastructure\Contracts\ViewInterface;
use DateTime;
use Exception;
use Ramsey\Uuid\UuidInterface;

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
    protected $created_at;

    /**
     * @var DateTime|null
     */
    protected $modified_at;

    /**
     * @var DateTime|null
     */
    protected $removed_at;

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
    public function getCreatedAt(): ?DateTime
    {
        return $this->created_at;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(?DateTime $createdAt): void
    {
        $this->created_at = $createdAt;
    }

    /**
     * @return DateTime|null
     */
    public function getModifiedAt(): ?DateTime
    {
        return $this->modified_at;
    }

    /**
     * @param DateTime|null $modifiedAt
     */
    public function setModifiedAt(?DateTime $modifiedAt): void
    {
        $this->modified_at = $modifiedAt;
    }

    /**
     * @return DateTime|null
     */
    public function getRemovedAt(): ?DateTime
    {
        return $this->removed_at;
    }

    /**
     * @param DateTime|null $removedAt
     */
    public function setRemovedAt(?DateTime $removedAt): void
    {
        $this->removed_at = $removedAt;
    }

    /**
     * @param array $params
     * @return View
     * @throws Exception
     */
    public static function fromArray(array $params)
    {
        throw new Exception("method_not_implemented");
    }
}
