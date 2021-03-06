<?php

namespace ACL\Infrastructure\Controller;

use ACL\Application\Command\UserListCommand;
use ACL\Domain\Entity\UserEntity;
use ACL\Infrastructure\Repository\UserRepository;
use ReallySimpleJWT\Token;
use Shared\Domain\Value\EmailValue;
use Shared\Infrastructure\Exception\DataValidateException;
use Shared\Infrastructure\Http\Request;
use Shared\Infrastructure\Http\Response;

final class AccessController
{
    public function authorizeUser(Request $request, Response $response)
    {
        $command = new UserListCommand(new UserRepository);
        
        $collection = $command->run(
            null,
            new EmailValue($request->body->email)
        );

        /**
         * @var UserEntity
         */
        $user = current($collection->getList());

        if (!$user) {
            throw new DataValidateException("E-mail ou senha inválidos");
        }

        $validPass = $user->getSenha()->compareWithOriginal($request->body->senha);

        if (!$validPass) {
            throw new DataValidateException("E-mail ou senha inválidos");
        }

        $payload = [
            'iat' => time(),
            'exp' => time() + (60*60),
            'iss' => 'localhost',
            'uid' => (String) $user->getId(),
            'nome' => $user->getNome(),
            'email' => $user->getEmail()->getValue(),
            'perfil' => $user->getPerfil()->getValue()
        ];
        
        $jwt = Token::customPayload($payload, getenv("JWT_PASS"));

        $response->json([
            "jwt" => $jwt
        ])->statusCode(200);
    }
}