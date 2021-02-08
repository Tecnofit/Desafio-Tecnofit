<?php

declare(strict_types=1);

use Symfony\Component\Dotenv\Dotenv;

if (!file_exists(__DIR__ . '/../.env')) {
    throw new Exception('Necessário ter o arquivo de ambiente');
}

(new Dotenv)->overload(__DIR__ . '/../.env');

return [
    'paths' => [
        'migrations' => 'migrations',
        'seeds' => 'seeds'
    ],
    'environments' => [
        'default_migration_table' => 'migrations',
        'default_database' => 'development',
        'production' => [
            'adapter' => 'mysqli',
            'host' => getenv('DB_RW_HOST'),
            'name' => getenv('DB_RW_DATABASE'),
            'user' => getenv('DB_RW_USER'),
            'pass' => getenv('DB_RW_PASSWORD'),
            'charset' => 'utf8'
        ],
        'development' => [
            'adapter' => 'mysqli',
            'host' => getenv('DB_RW_HOST'),
            'name' => getenv('DB_RW_DATABASE'),
            'user' => getenv('DB_RW_USER'),
            'pass' => getenv('DB_RW_PASSWORD'),
            'charset' => 'utf8'
        ]
    ],
    'version_order' => 'creation'
];
