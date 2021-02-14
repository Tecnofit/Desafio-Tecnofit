# DESAFIO TECNOFIT

Este repositório contem os arquivos do desafio tecnofit

## Pré - Requisitos

-   [laravel](http://laravel.com/)
-   [Composer](https://getcomposer.org/)

## Instalação

1. Clone este repositório para seu computador.
2. Navegue até o diretório e rode `composer install`.
3. Copie o arquivo `.env.example` para `.env`.
4. Crie um banco de dados MySql.
5. Edite o arquivo `.env` modificando as variaveis de acesso ao DB.
6. Execute `php artisan key:generate` para criar as chaves de segurança.
7. Execute a migração com `php artisan migrate:fresh --seed` para criar as tabelas no DB.
8. Execute `php artisan serve` para iniciar o servidor.
9. Acesse `localhost:8000` em seu navegador.

## Executar testes TDD

Na pasta do projeto execute:
`vendor\bin\phpunit`
