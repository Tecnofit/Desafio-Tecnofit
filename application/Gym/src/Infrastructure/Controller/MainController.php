<?php

namespace Gym\Infrastructure\Controller;

use ReallySimpleJWT\Token;
use Shared\Infrastructure\Exception\DataValidateException;
use Shared\Infrastructure\Http\Request;

abstract class MainController
{
    protected final static function authAluno(Request $request, $throw = True): bool
    {
        $data = self::validateToken($request);
        $autorizado = $data["perfil"] === "aluno";
        if ($throw && !$autorizado) {
            throw new DataValidateException("Não autorizado");
        }
        return $autorizado;
    }
    
    protected final static function authAdmin(Request $request, $throw = True): bool
    {
        $data = self::validateToken($request);
        $autorizado = $data["perfil"] === "admin";
        if ($throw && !$autorizado) {
            throw new DataValidateException("Não autorizado");
        }
        return $autorizado;
    }

    private final static function validateToken(Request $request): Array
    {
        $token = $request->headers["Authorization"] ?? null;

        if (!$token) {
            throw new DataValidateException("Acesso inválido");
        }

        $valid = Token::validate($token, getenv("JWT_PASS"));

        if (!$valid) {
            throw new DataValidateException("Acesso inválido");
        }

        $decoded = Token::getPayload($token, getenv("JWT_PASS"));

        if (time() > (int) $decoded["exp"]) {
            throw new DataValidateException("Sessão expirada");
        }

        return $decoded;
    }
}