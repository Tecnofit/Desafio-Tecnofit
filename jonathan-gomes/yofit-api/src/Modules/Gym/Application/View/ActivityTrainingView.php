<?php

declare(strict_types=1);

namespace App\Modules\Gym\Application\View;

use App\Infrastructure\View;

/**
 * Class ActivityTrainingView
 * @package App\Modules\Gym\Application\View
 */
class ActivityTrainingView extends View
{
    /**
     * @var int
     */
    private $activityId;

    /**
     * @var int
     */
    private $trainingId;

    /**
     * @var int
     */
    private $sections;

    /**
     * TrainingView constructor.
     * @param int $activityId
     * @param int $trainingId
     * @param int $sections
     */
    public function __construct(
        int $activityId,
        int $trainingId,
        int $sections = 0
    ) {
        $this->activityId = $activityId;
        $this->trainingId = $trainingId;
        $this->sections = $sections;
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
     * @return int
     */
    public function getSections(): int
    {
        return $this->sections;
    }

    /**
     * @param int $sections
     */
    public function setSections(int $sections): void
    {
        $this->sections = $sections;
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'activity_id' => $this->activityId,
            'training_id' => $this->trainingId,
            'sections'    => $this->sections
        ];
    }
}
