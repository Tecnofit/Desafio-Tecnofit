<?php

declare(strict_types=1);

namespace App\Modules\Gym\Handler\Training;

use App\Infrastructure\Handler;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;
use App\Modules\Gym\Application\View\Training\TrainingView;
use App\Modules\Gym\Domain\Entity\Training;
use Exception;
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
     * @throws Exception
     */
    public function handle(Request $request, ?array $uriParams): Response
    {
        try {
            $training = Training::where('id', $uriParams['id'] ?? 0)->firstOrFail();
            $training = $training->toArray();
        } catch (Throwable $e) {
            throw new Exception("training_not_found", 204);
        }

        $trainingView = new TrainingView($training['id'], $training['name'], $training['status'] === 1);

        return Response::json($trainingView);
    }
}
