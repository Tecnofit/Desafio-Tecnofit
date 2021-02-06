<?php

declare(strict_types=1);

use FastRoute\RouteCollector;
use App\Infrastructure\Router;
use App\Modules\Gym\Handler\Training\TrainingCreateHandler;
use App\Modules\Gym\Handler\Training\TrainingDetailHandler;
use App\Modules\Gym\Handler\Training\TrainingUpdateHandler;
use App\Modules\Gym\Handler\Activity\ActivityCreateHandler;
use App\Modules\Gym\Handler\Activity\ActivityDetailHandler;
use App\Modules\Gym\Handler\Activity\ActivityUpdateHandler;
use App\Modules\Gym\Handler\Activity\ActivityDeleteHandler;
use App\Modules\Gym\Handler\Activity\ActivityAssociateTrainingHandler;
use App\Modules\Gym\Handler\User\UserCreateHandler;
use App\Modules\Gym\Handler\User\UserUpdateHandler;
use App\Modules\Gym\Handler\User\UserDeleteHandler;
use App\Modules\Gym\Handler\Student\StudentTrainingsHandler;

return function (RouteCollector $r): void {
    $r->addGroup('/api', function (RouteCollector $r) {
        $r->addGroup('/v1', function (RouteCollector $r) {
            $r->addGroup('/training', function (RouteCollector $r) {
                $r->post('', [TrainingCreateHandler::class, Router::$IS_PUBLIC]);

                $r->get('/{uuid}', [TrainingDetailHandler::class, Router::$IS_PUBLIC]);

                $r->put('', [TrainingUpdateHandler::class, Router::$IS_PUBLIC]);
            });

            $r->addGroup('/activity', function (RouteCollector $r) {
                $r->post('', [ActivityCreateHandler::class, Router::$IS_PUBLIC]);

                $r->get('/{uuid}', [ActivityDetailHandler::class, Router::$IS_PUBLIC]);

                $r->put('', [ActivityUpdateHandler::class, Router::$IS_PUBLIC]);

                $r->delete('/{uuid}', [ActivityDeleteHandler::class, Router::$IS_PUBLIC]);

                $r->post('/{uuid_activity}/training/{uuid_training}/sections/{sections}',
                    [ActivityAssociateTrainingHandler::class,
                    Router::$IS_PUBLIC
                ]);
            });

            $r->addGroup('/user', function (RouteCollector $r) {
                $r->post('', [UserCreateHandler::class, Router::$IS_PUBLIC]);

                $r->put('', [UserUpdateHandler::class, Router::$IS_PUBLIC]);

                $r->delete('/{uuid}', [UserDeleteHandler::class, Router::$IS_PUBLIC]);
            });


            $r->addGroup('/student', function (RouteCollector $r) {
                $r->get('/{uuid}/trainings', [StudentTrainingsHandler::class, Router::$IS_PUBLIC]);
            });
        });
    });
};
