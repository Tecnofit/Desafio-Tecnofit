<?php

declare(strict_types=1);

namespace App\Modules\Gym\Application\View;

use App\Infrastructure\View;
use Ramsey\Uuid\UuidInterface;

/**
 * Class ActivityView
 * @package App\Modules\Gym\Application\View
 */
class ActivityView extends View
{
    /**
     * @var string|null $name
     */
    private $name;

    /**
     * TrainingView constructor.
     * @param int|null $id
     * @param UuidInterface|null $uuid
     * @param string|null $name
     */
    public function __construct(?int $id, ?UuidInterface $uuid, ?string $name)
    {
        $this->id = $id;
        $this->uuid = $uuid;
        $this->name = $name;
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
     * @return array
     */
    public function serialize(): array
    {
        return [
            'uuid' => $this->uuid ? $this->uuid->toString() : null,
            'name' => $this->name
        ];
    }
}
