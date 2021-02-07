<?php

declare(strict_types=1);

namespace App\Modules\Gym\Application\View;

use App\Infrastructure\View;

/**
 * Class StudentTrainingProgressView
 * @package App\Modules\Gym\Application\View
 */
class StudentTrainingProgressView extends View
{
    /**
     * @var string|null $status
     */
    private $status;

    /**
     * @var int $studentTrainingId
     */
    private $studentTrainingId;

    /**
     * @var int $activityId
     */
    private $activityId;

    /**
     * StudentTrainingByUserView constructor.
     * @param int $studentTrainingId
     * @param int $activityId
     * @param string|null $status
     */
    public function __construct(
        int $studentTrainingId,
        int $activityId,
        ?string $status = 'NOT_STARTED'
    )
    {
        $this->studentTrainingId = $studentTrainingId;
        $this->activityId = $activityId;
        $this->status = $status;
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
     * @return int
     */
    public function getStudentTrainingId(): int
    {
        return $this->studentTrainingId;
    }

    /**
     * @param int $studentTrainingId
     */
    public function setStudentTrainingId(int $studentTrainingId): void
    {
        $this->studentTrainingId = $studentTrainingId;
    }

    /**
     * @return int
     */
    public function getActivityId(): int
    {
        return $this->activityId;
    }

    /**
     * @param int $activityId
     */
    public function setActivityId(int $activityId): void
    {
        $this->activityId = $activityId;
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'student_training_id' => $this->studentTrainingId,
            'activity_id' => $this->activityId,
            'status' => $this->status
        ];
    }
}
