<?php

declare(strict_types=1);

namespace App\Modules\Gym\Handler\User;

use Ramsey\Uuid\Uuid;
use Throwable;
use App\Infrastructure\Handler;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;
use App\Modules\Gym\Domain\Repository\UserRepository;
use App\Modules\Gym\Application\Exception\User\UserRemovedSuccessfullyException;

/**
 * Class UserDeleteHandler
 * @package App\Modules\Gym\Handler\User
 */
class UserDeleteHandler extends Handler
{
    /**
     * @param Request $request
     * @param array|null $uriParams
     * @return Response
     * @throws Throwable
     */
    public function handle(Request $request, ?array $uriParams): Response
    {
        $uuid = Uuid::fromString($uriParams['uuid']);

        $user = UserRepository::getByUuId($uuid);

        UserRepository::remove($user['id']);

        throw new UserRemovedSuccessfullyException;
    }
}
