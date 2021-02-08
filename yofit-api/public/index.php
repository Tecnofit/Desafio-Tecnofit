<?php

declare(strict_types=1);

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Dotenv\Dotenv;
use App\Infrastructure\EventDispatcher as EventDispatcherAbstract;

date_default_timezone_set('America/Sao_Paulo');

require_once __DIR__ . '/../vendor/autoload.php';

(new Dotenv)->overload(__DIR__ . '/../.env');

error_reporting(E_ALL && ~E_DEPRECATED);

define('APP_ROOT', dirname(__DIR__));

ini_set('display_errors', $_ENV['APP_DEBUG']);

$request = App\Infrastructure\Http\Request::singleton();

try {
    App\Infrastructure\Middleware\CorsMiddleware::validate($request);

    $response = App\Infrastructure\Router::dispatcher($request);

    header('Content-Type: application/json');

    http_response_code($response->getStatusCode());

    $params = $response->getView()->serialize();

    if (array_key_exists('id', $params)) {
        unset($params['id']);
    }

    echo json_encode($params);

    if ($_ENV['APP_ENV'] !== 'development') {
        if (function_exists('fastcgi_finish_request')) {
            fastcgi_finish_request();
        }
    }

    if ($events = EventDispatcherAbstract::getEvents()) {
        $subscribers = require '../config/subscribers.php';
        $dispatcher  = new EventDispatcher;

        array_map(function ($subscriber) use ($dispatcher) {
            $dispatcher->addSubscriber(new $subscriber);
        }, $subscribers);

        foreach ($events as $eventName => $event) {
            try {
                $dispatcher->dispatch($event, $eventName);
            } catch (Throwable $e) {
                // TODO: Send to Sentry, Bugsnag or Logger
            }
        }
    }

    exit(0);
} catch (Throwable $e) {
    if ($_ENV['APP_ENV'] !== 'development') {
        // TODO: Send to Sentry, Bugsnag or Logger
    }

    http_response_code((int)$e->getCode());

    echo json_encode(['slug' => $e->getMessage()]);

    exit(1);
}
