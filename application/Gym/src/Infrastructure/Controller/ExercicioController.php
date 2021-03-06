<?php

namespace Gym\Infrastructure\Controller;

use Dotenv\Exception\ValidationException;
use Gym\Application\Command\ExercicioInsertCommand;
use Gym\Application\Command\ExercicioListCommand;
use Gym\Application\Command\ExercicioRemoveCommand;
use Gym\Application\Command\ExercicioUpdateCommand;
use Gym\Domain\Entity\ExercicioEntity;
use Gym\Infrastructure\Repository\ExercicioRepository;
use Gym\Infrastructure\Repository\TreinoRepository;
use Ramsey\Uuid\Uuid;
use Shared\Infrastructure\Exception\DataValidateException;
use Shared\Infrastructure\Http\Request;
use Shared\Infrastructure\Http\Response;

final class ExercicioController extends MainController
{
    public function insert(Request $request, Response $response)
    {
        self::authAdmin($request);

        if (!$request->body->nome) {
            throw new DataValidateException("O nome do exercício deve ser informado");
        }

        $exercicio = new ExercicioEntity(
            null,
            $request->body->nome ?? null,
            $request->body->descricao ?? "",
        );

        $command = new ExercicioInsertCommand(new ExercicioRepository);
        $command->run($exercicio);

        $response->json([
            "exercicio" => self::convertExercicioEntityToJson($exercicio)
        ])->statusCode(200);
    }

    public function update(Request $request, Response $response)
    {
        self::authAdmin($request);

        if (!$request->arguments->exercicioId) {
            throw new DataValidateException("O id do exercício deve ser informado");
        }

        if (!$request->body->nome) {
            throw new DataValidateException("O nome do exercício deve ser informado");
        }

        if (!Uuid::isValid($request->arguments->exercicioId)) {
            throw new DataValidateException("O id do exercício é inválido");
        }

        $exercicio = new ExercicioEntity(
            Uuid::fromString($request->arguments->exercicioId),
            $request->body->nome ?? null,
            $request->body->descricao ?? "",
        );

        $command = new ExercicioUpdateCommand(new ExercicioRepository);
        $command->run($exercicio);

        $response->json([
            "exercicio" => self::convertExercicioEntityToJson($exercicio)
        ])->statusCode(200);
    }

    public function getList(Request $request, Response $response)
    {
        self::authAdmin($request);
        
        $command = new ExercicioListCommand(new ExercicioRepository);
        $collection = $command->run();

        $response->json([
            "exercicios" => array_map(function (ExercicioEntity $exercicio) {
                return self::convertExercicioEntityToJson($exercicio);
            }, $collection->getList())
        ])->statusCode(200);
    }

    public function remove(Request $request, Response $response)
    {
        self::authAdmin($request);
        
        if (!$request->arguments->exercicioId) {
            throw new ValidationException("O id do exercício deve ser informado");
        }

        if (!Uuid::isValid($request->arguments->exercicioId)) {
            throw new ValidationException("O id do exercício é inválido");
        }

        $command = new ExercicioRemoveCommand(new ExercicioRepository, new TreinoRepository);
        $removed = $command->run(Uuid::fromString($request->arguments->exercicioId));

        $response->json([
            "status" => $removed
        ])->statusCode(200);
    }

    public function getExercicio(Request $request, Response $response)
    {
        if (!self::authAluno($request, false) && !self::authAdmin($request, false)) {
            self::authAdmin($request);
        }

        $command = new ExercicioListCommand(new ExercicioRepository);
        
        $collection = $command->run(
            Uuid::fromString($request->arguments->exercicioId)
        );
        
        $response->json([
            "exercicio" => self::convertExercicioEntityToJson(current($collection->getList()) ?: null)
        ])->statusCode(200);
    }

    private static function convertExercicioEntityToJson(?ExercicioEntity $exercicio = null): ?Array
    {
        if (!$exercicio) {
            return null;
        }

        return [
            "id" => (String) $exercicio->getId(),
            "nome" => $exercicio->getNome(),
            "descricao" => $exercicio->getDescricao(),
        ];
    }
}