<?php

declare(strict_types=1);

namespace App\Infrastructure;

/**
 * Class EventDispatcher
 *
 * @package App\Infrastructure
 */
abstract class EventDispatcher
{
    protected static $dispatch = [];

    /**
     * @param $instance
     * @param string $eventName
     */
    public static function pipe($instance, string $eventName)
    {
        self::$dispatch[$eventName] = $instance;
    }

    /**
     * @return array
     */
    public static function getEvents(): array
    {
        return self::$dispatch;
    }
}
