<?php

namespace App\Modules\Gym\Domain\Entity;

use App\Infrastructure\Model;

/**
 * Class StudentTrainingProgress
 *
 * @package App\Modules\Gym\Domain\Entity
 */
class StudentTrainingProgress extends Model
{
    protected $table = 'student_training_progress';

    public $timestamps = false;

    protected $fillable = [
        'student_training_id',
        'activity_id',
        'status'
    ];
}
