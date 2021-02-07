<?php

namespace App\Modules\Gym\Domain\Entity;

use App\Infrastructure\Model;

/**
 * Class ActivityTraining
 *
 * @package App\Modules\Gym\Domain\Entity
 */
class ActivityTraining extends Model
{
    protected $table = 'activity_training';

    public $timestamps = false;

    protected $fillable = [
        'activity_id',
        'training_id',
        'sections'
    ];
}
