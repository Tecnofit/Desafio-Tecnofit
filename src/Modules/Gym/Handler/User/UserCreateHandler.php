<?php

declare(strict_types=1);

namespace App\Modules\Gym\Handler\User;

use App\Modules\Gym\Application\Enum\UserEnum;
use App\Modules\Gym\Application\View\UserView;
use App\Modules\Gym\Domain\Repository\UserRepository;
use DateTime;
use Exception;
use Throwable;
use App\Infrastructure\Handler;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;

/**
 * Class UserCreateHandler
 * @package App\Modules\Gym\Handler\User
 */
class UserCreateHandler extends Handler
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

            $params['uuid'] = $request->getUuid();

            $params['created_at'] = new DateTime;

            $params['password'] = md5($params['password']);

            $params['status'] = UserEnum::$STATUS_ENABLED;

            $userView = UserView::fromArray($params);

            UserRepository::save($userView);

            return Response::json($userView);

        } catch (Throwable $e) {
            throw $e;
        }
    }
}
