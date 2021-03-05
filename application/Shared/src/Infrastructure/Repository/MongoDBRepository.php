<?php

namespace Shared\Infrastructure\Repository;

use MongoDB\Client as MongoClient;

abstract class MongoDBRepository
{
    public function database(): \MongoDB\Database
    {
        return (new MongoClient(
            "mongodb://".getenv("NOSQL_HOST").":".getenv("NOSQL_PORT"),
            [
                "username" => getenv("NOSQL_USER"),
                "password" => getenv("NOSQL_PASS")
            ]
        ))->tecnofit;
    }
}