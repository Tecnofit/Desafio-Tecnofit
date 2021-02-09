<?php

declare(strict_types=1);

namespace App\Modules\Gym\Application\View\StudentTraining;

use App\Infrastructure\View;

/**
 * Class StudentActivitiesByTrainingView
 * @package App\Modules\Gym\Application\View
 */
class StudentActivitiesByTrainingView extends View
{
    /**
     * @var array|null $activities
     */
    private $activities;

    /**
     * StudentTrainingByUserView constructor.
     * @param array|null $activities
     */
    public function __construct(?array $activities)
    {
        $this->activities = $activities;
    }

    /**
     * @return array|null
     */
    public function getActivities(): ?array
    {
        return $this->activities;
    }

    /**
     * @param array|null $activities
     */
    public function setActivities(?array $activities): void
    {
        $this->activities = $activities;
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return $this->activities;
    }
}
