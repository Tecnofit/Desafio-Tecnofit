<?php

namespace App\Tests\Unit\Modules\Gym\Application\View;

use Exception;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use App\Modules\Gym\Application\View\TrainingView;
use App\Tests\Unit\Mocks\NamesGenerator;

/**
 * Class TrainingViewTest
 * @package App\Tests\Unit\Modules\Gym\Application\View
 */
class TrainingViewTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testSerialize()
    {
        $trainingView = new TrainingView(
            random_int(0, 1000),
            Uuid::uuid4(),
            NamesGenerator::getRandomName(),
            true
        );

        $params = $trainingView->serialize();

        self::assertIsString($params);

        self::assertNotEmpty($params);

        self::assertArrayHasKey("id", $params);
        self::assertArrayHasKey("uuid", $params);
        self::assertArrayHasKey("name", $params);
        self::assertArrayHasKey("status", $params);
    }
}
