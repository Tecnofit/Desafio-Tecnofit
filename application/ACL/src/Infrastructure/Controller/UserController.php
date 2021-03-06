<?php

namespace ACL\Infrastructure\Controller;

use ACL\Application\Command\UserInsertCommand;
use ACL\Application\Command\UserListCommand;
use ACL\Application\Command\UserRemoveCommand;
use ACL\Application\Command\UserUpdateCommand;
use ACL\Domain\Entity\UserEntity;
use ACL\Infrastructure\Repository\UserRepository;
use Dotenv\Exception\ValidationException;
use Ramsey\Uuid\Uuid;
use Shared\Domain\Value\EmailValue;
use Shared\Domain\Value\SenhaValue;
use Shared\Domain\Value\UsuarioPerfilValue;
use Shared\Infrastructure\Exception\DataValidateException;
use Shared\Infrastructure\Http\Request;
use Shared\Infrastructure\Http\Response;

final class UserController
{
    public function insert(Request $request, Response $response)
    {
        if (!$request->body->senha) {
            throw new DataValidateException("A senha deve ser informada");
        }
        
        $user = new UserEntity(
            null,
            $request->body->nome,
            new EmailValue($request->body->email),
            SenhaValue::generatePassword($request->body->senha),
            new UsuarioPerfilValue($request->body->perfil)
        );

        $command = new UserInsertCommand(new UserRepository);
        $command->run($user);

        $response->json([
            "user" => self::convertUserEntityToJson($user)
        ])->statusCode(200);
    }

    public function update(Request $request, Response $response)
    {
        if (!$request->arguments->userId) {
            throw new ValidationException("O id do usuário deve ser informado");
        }

        if (!Uuid::isValid($request->arguments->userId)) {
            throw new ValidationException("O id do usuário é inválido");
        }

        $cmdFind = new UserListCommand(new UserRepository);
        $collectionFound = $cmdFind->run(Uuid::fromString($request->arguments->userId));
        $exists = current($collectionFound->getList());

        $user = new UserEntity(
            Uuid::fromString($request->arguments->userId),
            $request->body->nome,
            new EmailValue($request->body->email),
            $request->body->senha ? SenhaValue::generatePassword($request->body->senha) : $exists->getSenha(),
            new UsuarioPerfilValue($request->body->perfil)
        );

        $command = new UserUpdateCommand(new UserRepository);
        $command->run($user);

        $response->json([
            "user" => self::convertUserEntityToJson($user)
        ])->statusCode(200);
    }

    public function remove(Request $request, Response $response)
    {
        if (!$request->arguments->userId) {
            throw new ValidationException("O id do usuário deve ser informado");
        }

        if (!Uuid::isValid($request->arguments->userId)) {
            throw new ValidationException("O id do usuário é inválido");
        }

        $command = new UserRemoveCommand(new UserRepository);
        $removed = $command->run(Uuid::fromString($request->arguments->userId));

        $response->json([
            "status" => $removed
        ])->statusCode(200);
    }

    public function getList(Request $request, Response $response)
    {
        $command = new UserListCommand(new UserRepository);
        $collection = $command->run();

        $response->json([
            "users" => array_map(function (UserEntity $user) {
                return self::convertUserEntityToJson($user);
            }, $collection->getList())
        ])->statusCode(200);
    }

    public function getUser(Request $request, Response $response)
    {
        $command = new UserListCommand(new UserRepository);
        
        $collection = $command->run(
            Uuid::fromString($request->arguments->userId)
        );

        $response->json([
            "user" => self::convertUserEntityToJson(current($collection->getList()) ?: null)
        ])->statusCode(200);
    }

    private static function convertUserEntityToJson(?UserEntity $user = null): Array
    {
        if (!$user) {
            return [];
        }

        return [
            "id" => (String) $user->getId(),
            "nome" => $user->getNome(),
            "email" => $user->getEmail()->getValue(),
            "perfil" => $user->getPerfil()->getValue(),
            "perfilDescricao" => $user->getPerfil()->getDescricao(),
        ];
    }
}