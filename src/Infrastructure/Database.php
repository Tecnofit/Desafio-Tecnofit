<?php

namespace App\Infrastructure;

use Illuminate\Database\Capsule\Manager as Capsule;
use Throwable;

/**
 * Class Database
 *
 * @package App\Infrastructure
 */
abstract class Database
{
    public static function connection()
    {
        try {
            $capsule = new Capsule;

            $capsule->addConnection(
                [
                    'driver'    => $_ENV['DB_DRIVER'],
                    'host'      => $_ENV['DB_HOST'],
                    'database'  => $_ENV['DB_DATABASE'],
                    'username'  => $_ENV['DB_USER'],
                    'password'  => $_ENV['DB_PASSWORD'],
                    'charset'   => 'utf8',
                    'collation' => 'utf8_unicode_ci',
                    'prefix'    => '',
                ]
            );

            $capsule->bootEloquent();

            $capsule->setAsGlobal();

        } catch (Throwable $e) {
            return false;
        }
    }
}
