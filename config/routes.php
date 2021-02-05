<?php

declare(strict_types=1);

use FastRoute\RouteCollector;
use App\Infrastructure\Router;
use App\Modules\Gym\Handler\Training\TrainingDetailHandler;
use App\Modules\Gym\Handler\Training\TrainingCreateHandler;
use App\Modules\Gym\Handler\Training\TrainingUpdateHandler;

return function (RouteCollector $r): void {
    $r->addGroup('/api', function (RouteCollector $r) {
        $r->addGroup('/v1', function (RouteCollector $r) {
            $r->addGroup('/training', function (RouteCollector $r) {
                $r->post('', [TrainingCreateHandler::class, Router::$IS_PUBLIC]);
                $r->put('', [TrainingUpdateHandler::class, Router::$IS_PUBLIC]);
                $r->get('/{uuid}', [TrainingDetailHandler::class, Router::$IS_PUBLIC]);
            });
        });
    });
};
