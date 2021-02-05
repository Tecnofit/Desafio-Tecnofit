<?php

declare(strict_types=1);

namespace App\Modules\Gym\Application\View;

use App\Infrastructure\View;
use Ramsey\Uuid\UuidInterface;

/**
 * Class TrainingView
 * @package App\Modules\Gym\Application\View
 */
class TrainingView extends View
{
    /**
     * @var string|null $name
     */
    private $name;

    /**
     * @var bool|null $status
     */
    private $status;

    /**
     * TrainingView constructor.
     * @param int|null $id
     * @param UuidInterface|null $uuid
     * @param string|null $name
     * @param bool|null $status
     */
    public function __construct(
        ?int $id,
        ?UuidInterface $uuid,
        ?string $name,
        ?bool $status
    ) {
        $this->id     = $id;
        $this->uuid   = $uuid;
        $this->name   = $name;
        $this->status = $status;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return bool|null
     */
    public function getStatus(): ?bool
    {
        return $this->status;
    }

    /**
     * @param bool|null $status
     */
    public function setStatus(?bool $status): void
    {
        $this->status = $status;
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'id'     => $this->id,
            'uuid'   => $this->uuid ? $this->uuid->toString() : null,
            'name'   => $this->name,
            'status' => $this->status
        ];
    }
}
