<?php

namespace Gym\Infrastructure\Controller;

use Gym\Application\Command\ExercicioListCommand;
use Gym\Application\Command\TreinoInsertCommand;
use Gym\Application\Command\TreinoListCommand;
use Gym\Application\Command\TreinoUpdateCommand;
use Gym\Domain\Entity\TreinoEntity;
use Gym\Domain\Entity\TreinoExercicioCollection;
use Gym\Domain\Entity\TreinoExercicioEntity;
use Gym\Infrastructure\Repository\ExercicioRepository;
use Gym\Infrastructure\Repository\TreinoRepository;
use Ramsey\Uuid\Uuid;
use Shared\Infrastructure\Exception\DataValidateException;
use Shared\Infrastructure\Http\Request;
use Shared\Infrastructure\Http\Response;

final class TreinoController extends MainController
{
    public function insert(Request $request, Response $response)
    {
        self::authAdmin($request);

        if (!$request->body->nome) {
            throw new DataValidateException("O nome do treino deve ser informado");
        }

        $exercicios = new TreinoExercicioCollection;

        if ($request->body->exercicios && is_array($request->body->exercicios)) {
            foreach ($request->body->exercicios as $row) {
                $exercicios->append(new TreinoExercicioEntity(
                    null,
                    Uuid::fromString($row->exercicioId),
                    (int) $row->repeticoes
                ));
            }
        }

        $treino = new TreinoEntity(
            null,
            $request->body->nome ?? null,
            $request->body->descricao ?? "",
            $exercicios
        );

        $command = new TreinoInsertCommand(new TreinoRepository);
        $command->run($treino);

        $response->json([
            "treino" => self::convertTreinoEntityToJson($treino)
        ])->statusCode(200);
    }

    public function update(Request $request, Response $response)
    {
        self::authAdmin($request);

        if (!$request->arguments->treinoId) {
            throw new DataValidateException("O id do treino deve ser informado");
        }

        if (!$request->body->nome) {
            throw new DataValidateException("O nome do treino deve ser informado");
        }

        if (!Uuid::isValid($request->arguments->treinoId)) {
            throw new DataValidateException("O id do treino é inválido");
        }

        $exercicios = new TreinoExercicioCollection;

        if ($request->body->exercicios && is_array($request->body->exercicios)) {
            foreach ($request->body->exercicios as $row) {
                if ($row->exercicioId) {
                    $exercicios->append(new TreinoExercicioEntity(
                        $row->id ? Uuid::fromString($row->id) : null,
                        Uuid::fromString($row->exercicioId),
                        (int) $row->repeticoes
                    ));
                }
            }
        }

        $treino = new TreinoEntity(
            Uuid::fromString($request->arguments->treinoId),
            $request->body->nome ?? null,
            $request->body->descricao ?? "",
            $exercicios
        );

        $command = new TreinoUpdateCommand(new TreinoRepository);
        $command->run($treino);

        $response->json([
            "treino" => self::convertTreinoEntityToJson($treino)
        ])->statusCode(200);
    }

    public function getList(Request $request, Response $response)
    {
        self::authAdmin($request);

        $command = new TreinoListCommand(new TreinoRepository);
        $collection = $command->run();

        $response->json([
            "treinos" => array_map(function (TreinoEntity $treino) {
                return self::convertTreinoEntityToJson($treino);
            }, $collection->getList())
        ])->statusCode(200);
    }

    public function getTreino(Request $request, Response $response)
    {
        if (!self::authAluno($request, false) && !self::authAdmin($request, false)) {
            self::authAdmin($request);
        }

        $command = new TreinoListCommand(new TreinoRepository);
        
        $collection = $command->run(
            Uuid::fromString($request->arguments->treinoId)
        );
        
        $response->json([
            "treino" => self::convertTreinoEntityToJson(current($collection->getList()) ?: null)
        ])->statusCode(200);
    }

    private static function convertTreinoEntityToJson(?TreinoEntity $treino = null): ?Array
    {
        if (!$treino) {
            return null;
        }

        $commandExercicio = new ExercicioListCommand(new ExercicioRepository);

        return [
            "id" => (String) $treino->getId(),
            "nome" => $treino->getNome(),
            "descricao" => $treino->getDescricao(),
            "exercicios" => array_map(function (TreinoExercicioEntity $te) use ($commandExercicio) {
                $exercicio = $commandExercicio->run($te->getExercicioId())->get(0);
                return [
                    "treinoExercicioId" => (String) $te->getId(),
                    "exercicioId" => (String) $te->getExercicioId(),
                    "exercicioNome" => $exercicio ? $exercicio->getNome() : null,
                    "repeticoes" => $te->getRepeticoes(),
                ];
            }, $treino->getExercicios()->getList())
        ];
    }
}