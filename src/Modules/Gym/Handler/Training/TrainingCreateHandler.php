<?php

declare(strict_types=1);

namespace App\Modules\Gym\Handler\Training;

use App\Infrastructure\Handler;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;
use App\Modules\Gym\Application\Exception\Training\TrainingCreateBadRequest;
use App\Modules\Gym\Application\Exception\Training\TrainingNotSavedException;
use App\Modules\Gym\Application\View\TrainingView;
use App\Modules\Gym\Domain\Repository\TrainingRepository;
use Exception;
use Throwable;

/**
 * Class TrainingCreateHandler
 * @package App\Modules\Gym\Handler\Training
 */
class TrainingCreateHandler extends Handler
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

            $trainingView = new TrainingView(0, $request->getUuid(), $params['name'], $params['status'] ?? true);

            $trainingId = TrainingRepository::save($trainingView);

            $trainingView->setId(intval($trainingId));

            return Response::json($trainingView);
        } catch (TrainingNotSavedException $e) {
            throw $e;
        } catch (Throwable $e) {
            throw new TrainingCreateBadRequest;
        }
    }
}
