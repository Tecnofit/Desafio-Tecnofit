<?php

declare(strict_types=1);

namespace App\Modules\Gym\Handler\Training;

use App\Infrastructure\Handler;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;
use Exception;

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
        throw new Exception("Não foi possível cadastrar um treino");
    }
}
