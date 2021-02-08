<?php

namespace App\Infrastructure\Http;

use App\Infrastructure\Contracts\ResponseInterface;
use App\Infrastructure\Contracts\ViewInterface;

/**
 * Class Response
 *
 * @package App\Infrastructure\Http
 */
class Response implements ResponseInterface
{
    /**
     * @var ViewInterface
     */
    private $view;

    /**
     * @var int
     */
    private $statusCode;

    /**
     * Response constructor.
     *
     * @param ViewInterface $view
     * @param int $statusCode
     */
    private function __construct(ViewInterface $view, int $statusCode = 200)
    {
        $this->view = $view;
        $this->statusCode = $statusCode;
    }

    /**
     * @param ViewInterface $view
     * @param int $statusCode
     *
     * @return Response
     */
    public static function json(ViewInterface $view, int $statusCode = 200): Response
    {
        return new self($view, $statusCode);
    }

    /**
     * @return ViewInterface
     */
    public function getView(): ViewInterface
    {
        return $this->view;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
