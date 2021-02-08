<?php

namespace App\Modules\Gym\Domain\Entity;

use App\Infrastructure\Model;

/**
 * Class Profile
 *
 * @package App\Modules\Gym\Domain\Entity
 */
class Profile extends Model
{
    protected $table = 'profile';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'uuid',
        'name',
        'slug',
        'description'
    ];
}
