<?php

namespace App\Modules\Gym\Domain\Repository;

use Throwable;
use Ramsey\Uuid\UuidInterface;
use App\Modules\Gym\Application\Exception\User\UserNotFoundException;
use App\Modules\Gym\Application\Exception\User\UserNotRemovedException;
use App\Infrastructure\Contracts\ViewInterface;
use App\Modules\Gym\Application\Contract\ActivityRepositoryInterface;
use App\Modules\Gym\Application\Enum\UserEnum;
use App\Modules\Gym\Application\Exception\User\UserNotSavedException;
use App\Modules\Gym\Domain\Entity\User;

/**
 * Class UserRepository
 *
 * @package App\Modules\Gym\Domain\Repository
 */
abstract class UserRepository implements ActivityRepositoryInterface
{
    /**
     * @param UuidInterface $uuid
     * @return mixed
     * @throws UserNotFoundException
     */
    public static function getByUuId(UuidInterface $uuid)
    {
        try {
            return User::where('uuid', $uuid->toString())->firstOrFail()->toArray();
        } catch (Throwable $e) {
            throw new UserNotFoundException;
        }
    }

    /**
     * @param ViewInterface $view
     * @return bool
     * @throws UserNotSavedException
     */
    public static function save(ViewInterface $view)
    {
        try {
            $params = $view->serialize();

            if (empty($params['id'])) {
                unset($params['id']);
                return User::insertGetId($params);
            }

            return User::where('uuid', $params['uuid'])->update($params);

        } catch (Throwable $e) {
            throw new UserNotSavedException;
        }
    }

    /**
     * @param int $id
     * @throws UserNotRemovedException
     */
    public static function remove(int $id): void
    {
        try {
            User::where('id', $id)->update([
                'deleted_at' => date('Y-m-d H:i:s', time()),
                'status' => UserEnum::$STATUS_DELETED
            ]);

        } catch (Throwable $e) {
            throw new UserNotRemovedException;
        }
    }
}
