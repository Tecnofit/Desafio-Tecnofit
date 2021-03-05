<?php

namespace Gym\Infrastructure\Controller;

use DateTimeImmutable;
use Gym\Application\Command\AlunoTreinoChangeExercicioStatusCommand;
use Gym\Application\Command\AlunoTreinoInsertUpdateCommand;
use Gym\Application\Command\AlunoTreinoListCommand;
use Gym\Domain\Entity\AlunoTreinoEntity;
use Gym\Domain\Entity\AlunoTreinoExercicioEntity;
use Gym\Infrastructure\Repository\AlunoTreinoRepository;
use Gym\Infrastructure\Repository\TreinoRepository;
use Ramsey\Uuid\Uuid;
use Shared\Infrastructure\Exception\DataValidateException;
use Shared\Infrastructure\Http\Request;
use Shared\Infrastructure\Http\Response;

final class AlunoTreinoController extends MainController
{
    public function insertUpdate(Request $request, Response $response)
    {
        self::authAdmin($request);

        if (!$request->body->treinoId) {
            throw new DataValidateException("O id do treino deve ser informado");
        }

        if (!$request->arguments->userId) {
            throw new DataValidateException("O id do usuário deve ser informado");
        }

        if (!$request->body->expiracao) {
            throw new DataValidateException("A data de expiração do treino deve ser informada");
        }

        $command = new AlunoTreinoInsertUpdateCommand(new AlunoTreinoRepository, new TreinoRepository);
        $alunoTreino = $command->run (
            Uuid::fromString($request->arguments->userId),
            Uuid::fromString($request->body->treinoId),
            new DateTimeImmutable($request->body->expiracao . " 23:59:59"),
        );

        $response->json([
            "alunoTreino" => self::convertAlunoTreinoEntityToJson($alunoTreino)
        ])->statusCode(200);
    }

    public function getSingle(Request $request, Response $response)
    {
        if (!self::authAluno($request, false) && !self::authAdmin($request, false)) {
            self::authAdmin($request);
        }

        $command = new AlunoTreinoListCommand(new AlunoTreinoRepository);
        $collection = $command->run(
            null,
            $request->arguments->userId ? Uuid::fromString($request->arguments->userId) : null,
            null
        );
        
        $response->json([
            "alunoTreino" => self::convertAlunoTreinoEntityToJson(current($collection->getList()) ?: null)
        ])->statusCode(200);
    }

    public function changeExercicioStatus(Request $request, Response $response)
    {
        self::authAluno($request);

        if (!$request->arguments->userId) {
            throw new DataValidateException("O id do usuário deve ser informado");
        }

        $command = new AlunoTreinoChangeExercicioStatusCommand(new AlunoTreinoRepository);
        $alunoTreino = $command->run (
            Uuid::fromString($request->arguments->userId),
            Uuid::fromString($request->body->alunoTreinoId),
            Uuid::fromString($request->body->alunoTreinoExercicioId),
            (bool) $request->body->executado
        );

        $response->json([
            "status" => true
        ])->statusCode(200);
    }

    private static function convertAlunoTreinoEntityToJson(?AlunoTreinoEntity $alunoTreino = null): ?Array
    {
        if (!$alunoTreino) {
            return null;
        }

        return [
            "id" => (String) $alunoTreino->getId(),
            "treinoId" => (String) $alunoTreino->getTreinoId(),
            "usuarioId" => (String) $alunoTreino->getUsuarioId(),
            "expiracao" => $alunoTreino->getExpiracao()->format("Y-m-d H:i:s"),
            "ativo" => $alunoTreino->getExpiracao()->getTimestamp() > time(),
            "exercicios" => $alunoTreino->getExercicios()->map(function(AlunoTreinoExercicioEntity $alunoTreinoExercicio) {
                return [
                    'treinoExercicioId' => (String) $alunoTreinoExercicio->getTreinoExercicioId(),
                    'alunoTreinoExercicioId' => (String) $alunoTreinoExercicio->getId(),
                    'exercicioId' => (String) $alunoTreinoExercicio->getExercicioId(),
                    'executado' => $alunoTreinoExercicio->getExecuted(),
                ];
            })
        ];
    }
}