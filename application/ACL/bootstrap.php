<?php

declare(strict_types=1);

use Dotenv\Dotenv;

require 'vendor/autoload.php';

date_default_timezone_set('America/Sao_Paulo');

Dotenv::createImmutable(__DIR__)->load();

define('ROOT_PATH', __DIR__);