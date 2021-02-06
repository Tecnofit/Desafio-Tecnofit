<?php

declare(strict_types=1);

namespace App\Modules\Gym\Handler\User;

use DateTime;
use Ramsey\Uuid\Uuid;
use Throwable;
use App\Infrastructure\Handler;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;
use App\Modules\Gym\Domain\Repository\UserRepository;
use App\Modules\Gym\Application\View\UserView;

/**
 * Class UserUpdateHandler
 * @package App\Modules\Gym\Handler\User
 */
class UserUpdateHandler extends Handler
{
    /**
     * @param Request $request
     * @param array|null $uriParams
     * @return Response
     * @throws Throwable
     */
    public function handle(Request $request, ?array $uriParams): Response
    {
        try {
            $params = $request->getBody();

            $uuid = Uuid::fromString($params['uuid']);

            $user = UserRepository::getByUuId($uuid);

            $params['id'] = $user['id'];

            $params['uuid'] = $uuid;

            $params['created_at'] = new DateTime($user['created_at']);

            $params['updated_at'] = new DateTime;

            $params['deleted_at'] = $user['deleted_at'] ? new DateTime($user['deleted_at']) : null;

            $userView = UserView::fromArray($params);

            UserRepository::save($userView);

            return Response::json($userView);

        } catch (Throwable $e) {
            throw $e;
        }
    }
}
