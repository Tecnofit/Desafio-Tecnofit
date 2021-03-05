<?php

declare(strict_types=1);

use Shared\Infrastructure\Http\Request;

require '../bootstrap.php';

Request::route("POST",   "/v1/user",                'ACL\Infrastructure\Controller\UserController::insert');
Request::route("PUT",    "/v1/user/{userId}",       'ACL\Infrastructure\Controller\UserController::update');
Request::route("DELETE", "/v1/user/{userId}",       'ACL\Infrastructure\Controller\UserController::remove');
Request::route("GET",    "/v1/user",                'ACL\Infrastructure\Controller\UserController::getList');
Request::route("GET",    "/v1/user/{userId}",       'ACL\Infrastructure\Controller\UserController::getUser');
Request::route("POST",   "/v1/user/{userId}/roles", 'ACL\Infrastructure\Controller\UserRoleController::insert');
Request::route("PUT",    "/v1/user/{userId}/roles", 'ACL\Infrastructure\Controller\UserRoleController::update');
Request::route("POST",   "/v1/access/auth",         'ACL\Infrastructure\Controller\AccessController::authorizeUser');

http_response_code(404);
die("Page not found");