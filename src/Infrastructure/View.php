<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Infrastructure\Contracts\ViewInterface;
use DateTime;

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
     * @var DateTime|null
     */
    protected $created_at;

    /**
     * @var DateTime|null
     */
    protected $modified_at;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id ?: 0;
    }

    /**
     * @param int $id
     * @return int
     */
    public function setId(int $id): void
    {
        $this->id = $id;
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
}
