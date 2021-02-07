<?php

declare(strict_types=1);

use App\Infrastructure\Database;
use Symfony\Component\Dotenv\Dotenv;

date_default_timezone_set('America/Sao_Paulo');

require_once __DIR__ . '/../vendor/autoload.php';

(new Dotenv)->overload(__DIR__ . '/../.env');

error_reporting(E_ALL && ~E_DEPRECATED);

define('APP_ROOT', dirname(__DIR__));

ini_set('display_errors', $_ENV['APP_DEBUG']);

// TODO: Trabalhar com banco em memória. Ex: SQLite

Database::connection();
