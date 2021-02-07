<?php

namespace App\Tests\Integration\Modules\Gym\Handler;

use Exception;
use PHPUnit\Framework\TestCase;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;
use App\Modules\Gym\Application\View\TrainingView;
use App\Modules\Gym\Handler\Training\TrainingCreateHandler;
use App\Tests\Unit\Mocks\NamesGenerator;

/**
 * Class TrainingCreateHandlerTest
 * @package App\Tests\Unit\Modules\Gym\Application\View
 */
class TrainingCreateHandlerTest extends TestCase
{
    /**
     * @param array $data
     * @param bool $isErrorExcepted
     * @dataProvider getData()
     */
    public function testHandle($data, $isErrorExcepted = false)
    {
        $trainingCreateHandler = new TrainingCreateHandler;

        $request = Request::singleton();

        $request->setBody($data);

        $exception = null;
        $response = null;

        try {
            $response = $trainingCreateHandler->handle($request, null);
        } catch (Exception $e) {
            $exception = $e;
        }

        if ($isErrorExcepted) {
            self::assertNotNull($exception);
            print("\n". $exception->getMessage());
        } else {
            self::assertNotEmpty($response);
            self::assertInstanceOf(Response::class, $response);
            self::assertInstanceOf(TrainingView::class, $response->getView());
        }
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getData(): array
    {
        return [
            [
                [
                    'name' => NamesGenerator::getRandomName(),
                    'status' => true,
                ],
            ],
            [
                [
                    'name' => NamesGenerator::getRandomName(),
                    'status' => false,
                ]
            ],
            [
                [
                    'status' => NamesGenerator::getRandomName(),
                ],
                true
            ],
            [
                null,
                true
            ],
            [
                [
                    'name' => 'Braço'
                ],
                true
            ]
        ];
    }
}
