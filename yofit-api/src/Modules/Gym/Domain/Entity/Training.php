<?php

namespace App\Modules\Gym\Domain\Entity;

use App\Infrastructure\Model;

/**
 * Class Training
 *
 * @package App\Modules\Gym\Domain\Entity
 */
class Training extends Model
{
    protected $table = 'training';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'status'
    ];
}
