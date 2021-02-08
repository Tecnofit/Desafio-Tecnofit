<?php

namespace App\Modules\Gym\Domain\Entity;

use App\Infrastructure\Model;

/**
 * Class Activity
 *
 * @package App\Modules\Gym\Domain\Entity
 */
class Activity extends Model
{
    protected $table = 'activity';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'uuid',
        'name'
    ];
}
