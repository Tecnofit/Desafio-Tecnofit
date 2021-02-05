<?php

declare(strict_types=1);

namespace App\Modules\Gym\Handler\Training;

use App\Infrastructure\Handler;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;
use App\Modules\Gym\Application\Exception\Training\TrainingNotSavedException;
use App\Modules\Gym\Application\Exception\Training\TrainingParameterWrongException;
use App\Modules\Gym\Application\Exception\Training\TrainingUpdateBadRequest;
use App\Modules\Gym\Application\View\TrainingView;
use App\Modules\Gym\Domain\Repository\TrainingRepository;
use Exception;
use Ramsey\Uuid\Uuid;
use Throwable;

/**
 * Class TrainingUpdateHandler
 * @package App\Modules\Gym\Handler\Training
 */
class TrainingUpdateHandler extends Handler
{
    /**
     * @param Request $request
     *
     * @param array $uriParams
     *
     * @return Response
     * @throws Exception
     */
    public function handle(Request $request, ?array $uriParams): Response
    {
        try {
            $params = $request->getBody();

            $this->validate($params);

            $uuid = Uuid::fromString($params['uuid']);

            $trainingView = new TrainingView(
                intval($params['id']),
                $uuid,
                $params['name'],
                $params['status']
            );

            TrainingRepository::save($trainingView);

            return Response::json($trainingView);
        } catch (TrainingParameterWrongException $e) {
            throw $e;
        } catch (TrainingNotSavedException $e) {
            throw $e;
        } catch (Throwable $e) {
            throw new TrainingUpdateBadRequest;
        }
    }

    /**
     * @param array $params
     * @throws TrainingParameterWrongException
     */
    private function validate(array $params)
    {
        if (!array_key_exists('uuid', $params)) {
            throw new TrainingParameterWrongException("uuid");
        }

        if (!array_key_exists('name', $params)) {
            throw new TrainingParameterWrongException("name");
        }

        if (!array_key_exists('status', $params)) {
            throw new TrainingParameterWrongException("status");
        }
    }
}
