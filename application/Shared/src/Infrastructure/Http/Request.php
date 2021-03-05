<?php

namespace Shared\Infrastructure\Http;

use ArrayObject;
use Exception;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Shared\Infrastructure\Exception\DataValidateException;
use stdClass;
use Throwable;

final class Request
{
    public String $path;
    public Array $query;
    public String $method;
    public stdClass $arguments;
    public String $bodyContent;
    public Object $body;
    public Array $headers;

    public static function route(String $method, String $path, $callback): void
    {
        http_response_code(400);

        header('Cache-Control: no-cache, no-store, must-revalidate, proxy-revalidate, max-age=0');
        header('Pragma: no-cache');
        header('Last-Modified:' . gmdate('D, d M Y H:i:s ') . 'GMT');
        header('Expires: 0');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header("Access-Control-Allow-Headers: *");
        
        if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
            http_response_code(200);
            exit;
        }

        if (strtoupper($_SERVER["REQUEST_METHOD"]) !== strtoupper($method)) {
            return;
        }

        $requestUri = current(explode("?", $_SERVER["REQUEST_URI"]));
    
        preg_match_all('/[\{](.*?)[\}]/', $path, $argumentsFound);
    
        $requestPath = $path;
        $path = str_replace('/','\/', trim($path, "\/"));
    
        $variables = [];
        $pathReplaced = $path;
        if (count($argumentsFound) > 0) {
            $variables = $argumentsFound[1];
            $pathReplaced = str_replace($argumentsFound[0], "([^\/]*)", $path);
        }
    
        $re = '/'. $pathReplaced .'$/';
        preg_match($re, trim($requestUri, "\/"), $matches);
        
        if (count($matches) === 0) {
            return;
        }

        $request = new Request();
        $request->path = $requestPath;
        $request->query = $_GET;
        $request->method = $method;
        $request->headers = getallheaders();
        $request->bodyContent = file_get_contents('php://input');
        $request->body = (Object) json_decode($request->bodyContent);
    
        $request->arguments = new stdClass;
        foreach( $variables as $i => $v) {
            $request->arguments->$v = $matches[$i+1] ?? null;
        }
    
        $response = new Response;
        $response->statusCode(400);

        try {
            call_user_func_array($callback, [$request, $response]);
        } catch (DataValidateException $e) {
            $response->json([
                "errors" => $e->messages
            ])->statusCode(400);
            // echo '<pre>'; print_r($e); exit;
        } catch (Throwable $e) {
            echo '<pre>'; print_r($e); exit;
            // echo '<pre>'; print_r($e); exit;
            $response->json([
                "errors" => [$e->getMessage()]
            ])->statusCode(400);
        }
        
        $response->parse();

        exit;
    }
}