<?php

declare(strict_types=1);

use Shared\Infrastructure\Http\Request;

require '../bootstrap.php';

Request::route("POST",   "/v1/exercicio",                'Gym\Infrastructure\Controller\ExercicioController::insert');
Request::route("PUT",    "/v1/exercicio/{exercicioId}",  'Gym\Infrastructure\Controller\ExercicioController::update');
Request::route("GET",    "/v1/exercicio",                'Gym\Infrastructure\Controller\ExercicioController::getList');
Request::route("GET",    "/v1/exercicio/{exercicioId}",  'Gym\Infrastructure\Controller\ExercicioController::getExercicio');
Request::route("DELETE", "/v1/exercicio/{exercicioId}",  'Gym\Infrastructure\Controller\ExercicioController::remove');

Request::route("POST",   "/v1/treino",                   'Gym\Infrastructure\Controller\TreinoController::insert');
Request::route("PUT",    "/v1/treino/{treinoId}",        'Gym\Infrastructure\Controller\TreinoController::update');
Request::route("GET",    "/v1/treino",                   'Gym\Infrastructure\Controller\TreinoController::getList');
Request::route("GET",    "/v1/treino/{treinoId}",        'Gym\Infrastructure\Controller\TreinoController::getTreino');

Request::route("GET",    "/v1/aluno/{userId}/treino",    'Gym\Infrastructure\Controller\AlunoTreinoController::getSingle');
Request::route("POST",   "/v1/aluno/{userId}/treino",    'Gym\Infrastructure\Controller\AlunoTreinoController::insertUpdate');
Request::route("PUT",    "/v1/aluno/{userId}/treino",    'Gym\Infrastructure\Controller\AlunoTreinoController::insertUpdate');
Request::route("PUT",    "/v1/aluno/{userId}/treino/exercicio/status", 'Gym\Infrastructure\Controller\AlunoTreinoController::changeExercicioStatus');

http_response_code(404);
die("Page not found");