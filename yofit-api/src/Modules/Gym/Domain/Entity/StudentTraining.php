<?php

namespace App\Modules\Gym\Domain\Entity;

use App\Infrastructure\Model;

/**
 * Class StudentTraining
 *
 * @package App\Modules\Gym\Domain\Entity
 */
class StudentTraining extends Model
{
    protected $table = 'student_training';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'uuid',
        'user_id',
        'training_id',
        'status'
    ];
}
