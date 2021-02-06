<?php

namespace App\Modules\Gym\Domain\Repository;

use App\Modules\Gym\Application\Contract\ActivityRepositoryInterface;
use App\Modules\Gym\Application\Exception\Profile\ProfileNotFoundException;
use App\Modules\Gym\Domain\Entity\Profile;
use Ramsey\Uuid\UuidInterface;
use Throwable;

/**
 * Class ProfileRepository
 *
 * @package App\Modules\Gym\Domain\Repository
 */
abstract class ProfileRepository implements ActivityRepositoryInterface
{
    /**
     * @param UuidInterface $uuid
     * @return mixed
     * @throws ProfileNotFoundException
     */
    public static function getByUuId(UuidInterface $uuid)
    {
        try {
            return Profile::where('uuid', $uuid->toString())->firstOrFail()->toArray();
        } catch (Throwable $e) {
            throw new ProfileNotFoundException;
        }
    }
}
