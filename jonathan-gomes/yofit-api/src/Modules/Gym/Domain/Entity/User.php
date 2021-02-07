<?php

namespace App\Modules\Gym\Domain\Entity;

use App\Infrastructure\Model;

/**
 * Class User
 *
 * @package App\Modules\Gym\Domain\Entity
 */
class User extends Model
{
    protected $table = 'user';

    public $timestamps = false;

    protected $fillable = [
        'id',
        'uuid',
        'profile_id',
        'password',
        'status',
        'email',
        'first_name',
        'middle_name',
        'last_name',
        'weight',
        'height',
        'photo',
        'birth_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
