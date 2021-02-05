<?php

namespace App\Modules\Gym\Domain\Repository;

use App\Infrastructure\Contracts\ViewInterface;
use App\Modules\Gym\Application\Contract\TrainingRepositoryInterface;
use App\Modules\Gym\Application\Exception\Training\TrainingNotFoundException;
use App\Modules\Gym\Application\Exception\Training\TrainingNotSavedException;
use App\Modules\Gym\Domain\Entity\Training;
use Ramsey\Uuid\UuidInterface;
use Throwable;

/**
 * Class TrainingRepository
 *
 * @package App\Modules\Gym\Domain\Repository
 */
abstract class TrainingRepository implements TrainingRepositoryInterface
{
    /**
     * @param UuidInterface $uuid
     * @return mixed
     * @throws TrainingNotFoundException
     */
    public static function getByUuId(UuidInterface $uuid)
    {
        try {
            return Training::where('uuid', $uuid->toString())->firstOrFail()->toArray();
        } catch (Throwable $e) {
            throw new TrainingNotFoundException;
        }
    }

    /**
     * @param ViewInterface $view
     * @return bool
     * @throws TrainingNotSavedException
     */
    public static function save(ViewInterface $view)
    {
        try {
            $params = $view->serialize();

            if (empty($params['id'])) {
                unset($params['id']);
                return Training::insertGetId($params);
            }


            return Training::where('uuid', $params['uuid'])->update($params);
        } catch (Throwable $e) {
            throw new TrainingNotSavedException;
        }
    }
}
