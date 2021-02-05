<?php

declare(strict_types=1);

namespace App\Modules\Gym\Handler\Training;

use App\Infrastructure\Handler;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;
use App\Modules\Gym\Application\Exception\Training\TrainingNotFoundException;
use App\Modules\Gym\Application\View\TrainingView;
use App\Modules\Gym\Domain\Repository\TrainingRepository;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;
use Throwable;

/**
 * Class TrainingDetailHandler
 * @package App\Modules\Gym\Handler\Training
 */
class TrainingDetailHandler extends Handler
{
    /**
     * @param Request $request
     *
     * @param array $uriParams
     *
     * @return Response
     * @throws Throwable
     */
    public function handle(Request $request, ?array $uriParams): Response
    {
        try {
            $uuid = Uuid::fromString($uriParams['uuid']);

            $training = TrainingRepository::getByUuId($uuid);

            $trainingView = new TrainingView($training['id'], $uuid, $training['name'], $training['status'] === 1);

            return Response::json($trainingView);
        } catch (InvalidUuidStringException $e) {
            throw new TrainingNotFoundException;
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
