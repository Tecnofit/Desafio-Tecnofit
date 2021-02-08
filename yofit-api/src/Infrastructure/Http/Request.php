<?php

namespace App\Infrastructure\Http;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Request
 *
 * @package App\Infrastructure\Http
 */
class Request
{
    /**
     * @var null $instance
     */
    private static $instance = null;

    /**
     * @var $body
     */
    private $body;

    /**
     * Request constructor.
     */
    private function __construct()
    {
        $this->setBody();
    }

    /**
     * @return Request|null
     */
    public static function singleton()
    {
        if (!self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        $uri = $_SERVER['REQUEST_URI'];

        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }

        return rawurldecode($uri);
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @return string
     */
    public function getRemoteAddr(): string
    {
        return $_SERVER['REMOTE_ADDR'];
    }

    /**
     * @return string|null
     */
    public function getUserAgent(): ?string
    {
        return $_SERVER['HTTP_USER_AGENT'] ?? null;
    }

    /**
     * @param string|null $queryStringKey
     *
     * @return mixed
     */
    public function getQueryString(?string $queryStringKey = null)
    {
        if (!empty($_GET)) {
            return $queryStringKey ? $_GET[$queryStringKey] ?? null : $_GET;
        }

        if (!empty($_POST)) {
            return $queryStringKey ? $_POST[$queryStringKey] ?? null : $_POST;
        }

        return null;
    }

    /**
     * @return array
     */
    public function getBody(): ?array
    {
        return $this->body;
    }

    /**
     * @param array|null $params
     * @return void
     */
    public function setBody(?array $params = null): void
    {
        if (empty($params)) {
            $this->body = json_decode(file_get_contents("php://input", false, stream_context_get_default(), 0, (int)$_SERVER["CONTENT_LENGTH"]), true);
            return;
        }

        $this->body = $params;
    }

    /**
     * @param string|null $headerKey
     *
     * @return mixed
     */
    public function getHeaders(?string $headerKey = null)
    {
        if ($headerKey) {
            return getallheaders()[$headerKey] ?? null;
        }

        return getallheaders();
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        preg_match('/Bearer\s(\S+)+/', $_SERVER['HTTP_AUTHORIZATION'], $token);

        return $token[1] ?? null;
    }

    /**
     * @return string|null
     */
    public function getOrigin(): ?string
    {
        return $_SERVER['HTTP_HOST'] ?? null;
    }

    /**
     * @return string
     */
    public function getFullUrl(): string
    {
        return sprintf('%s://%s', $this->getProtocol(), $_SERVER['HTTP_HOST']);
    }

    /**
     * @return string
     */
    public function getProtocol(): string
    {
        return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
    }

    /**
     * @return Uuid
     */
    public function getUuid(): UuidInterface
    {
        return Uuid::uuid4();
    }
}
