<?php

declare(strict_types=1);

namespace App\Modules\Gym\Handler\Training;

use App\Infrastructure\Handler;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;
use App\Modules\Gym\Application\View\Training\TrainingView;
use Exception;

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
     * @throws Exception
     */
    public function handle(Request $request, ?array $uriParams): Response
    {
        // TODO: Consultar treino

        $trainingView = new TrainingView(
            intval($uriParams['id'] ?? 0),
            "Perna",
            true
        );

        return Response::json($trainingView);
    }
}
