<?php

namespace Shared\Infrastructure\Http;

use ArrayObject;

final class Response
{
    public String $code;
    public String $payload;
    public Array $headers = [];

    public function parse()
    {
        foreach ($this->headers as $header) {
            header($header);
        }
        http_response_code($this->code);
        echo $this->payload;
        exit;
    }

    public function json($data)
    {
        $this->headers[] = 'Content-Type: application/json';
        $this->payload = json_encode($data);
        return $this;
    }

    public function statusCode(int $code)
    {
        $this->code = $code;
        return $this;
    }
}