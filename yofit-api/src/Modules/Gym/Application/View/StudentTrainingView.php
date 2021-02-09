<?php

declare(strict_types=1);

namespace App\Modules\Gym\Application\View;

use App\Infrastructure\View;
use Ramsey\Uuid\UuidInterface;

/**
 * Class StudentTrainingView
 * @package App\Modules\Gym\Application\View
 */
class StudentTrainingView extends View
{
    /**
     * @var int
     */
    private $userId;

    /**
     * @var int
     */
    private $trainingId;

    /**
     * @var string|null
     */
    private $status;

    /**
     * StudentTrainingByUserView constructor.
     * @param int|null $id
     * @param UuidInterface $uuid
     * @param int $userId
     * @param int $trainingId
     * @param string|null $status
     */
    public function __construct(
        ?int $id,
        UuidInterface $uuid,
        int $userId,
        int $trainingId,
        ?string $status = 'DISABLED'
    )
    {
        $this->id = $id;
        $this->uuid = $uuid;
        $this->userId = $userId;
        $this->trainingId = $trainingId;
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getTrainingId(): int
    {
        return $this->trainingId;
    }

    /**
     * @param int $trainingId
     */
    public function setTrainingId(int $trainingId): void
    {
        $this->trainingId = $trainingId;
    }

    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string|null $status
     */
    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid->toString(),
            'user_id' => $this->userId,
            'training_id' => $this->trainingId,
            'status' => $this->status
        ];
    }
}
