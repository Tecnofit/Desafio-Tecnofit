<?php

declare(strict_types=1);

namespace App\Modules\Gym\Application\View\StudentTraining;

use App\Infrastructure\View;

/**
 * Class StudentTrainingByUserView
 * @package App\Modules\Gym\Application\View
 */
class StudentTrainingByUserView extends View
{
    /**
     * @var array|null $trainings
     */
    private $trainings;

    /**
     * StudentTrainingByUserView constructor.
     * @param array|null $trainings
     */
    public function __construct(?array $trainings)
    {
        $this->trainings = $trainings;
    }

    /**
     * @return array|null
     */
    public function getTrainings(): ?array
    {
        return $this->trainings;
    }

    /**
     * @param array|null $trainings
     */
    public function setTrainings(?array $trainings): void
    {
        $this->trainings = $trainings;
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return $this->trainings;
    }
}
