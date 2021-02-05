<?php

namespace App\Modules\Gym\Domain\Repository;

use App\Infrastructure\Contracts\ViewInterface;
use App\Modules\Gym\Application\Contract\ActivityRepositoryInterface;
use App\Modules\Gym\Application\Exception\Activity\ActivityNotFoundException;
use App\Modules\Gym\Application\Exception\Activity\ActivityNotSavedException;
use App\Modules\Gym\Domain\Entity\Activity;
use Ramsey\Uuid\UuidInterface;
use Throwable;

/**
 * Class ActivityRepository
 *
 * @package App\Modules\Gym\Domain\Repository
 */
abstract class ActivityRepository implements ActivityRepositoryInterface
{
    /**
     * @param UuidInterface $uuid
     * @return mixed
     * @throws ActivityNotFoundException
     */
    public static function getByUuId(UuidInterface $uuid)
    {
        try {
            return Activity::where('uuid', $uuid->toString())->firstOrFail()->toArray();
        } catch (Throwable $e) {
            throw new ActivityNotFoundException;
        }
    }

    /**
     * @param ViewInterface $view
     * @return bool
     * @throws ActivityNotSavedException
     */
    public static function save(ViewInterface $view)
    {
        try {
            $params = $view->serialize();

            if (empty($view->getId())) {
                unset($params['id']);
                return Activity::insertGetId($params);
            }

            return Activity::where('uuid', $params['uuid'])->update($params);

        } catch (Throwable $e) {
            throw new ActivityNotSavedException;
        }
    }
}
