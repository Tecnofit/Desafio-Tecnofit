# YOFIT Api
> Sistema de gerenciamento de treinos e exercícios
 
__Tabela de Conteúdos__
=====================

* [Yofit](#yofit)
    * [Tabela de Conteúdos](#tabela-de-contedos)
    * [Objetivo](#objetivo)
    * [Requisitos](#requisitos)
    * [Recursos](#recursos)
    * [Ambiente](#ambiente)
    * [Testes](#testes)
        * [Unitários](#unitarios)
        * [Integração](#integracao)
    * [Contribuintes](#contribuintes)

## Objetivo

- Proporcionar uma qualidade de vida melhor a você
- Melhorar sua gestão de exercícios no seu dia-a-dia

## Requisitos

* Docker
* Docker Compose
* Composer
* Ferramenta de Conexão Com BD - MySQL

## Recursos

- PHP
  
  - Fast Route (Roteamento de api)
  - JWT (Segurança na autenticação do usuário)
  - Event Dispatcher (Eventos)
  - Symfony/Console (Rotinas para o cronJob)
  - Phinx (Gestão do banco)
  - Swift Mailer (Disparo de e-mails)
  - Sentry (Monitoramento de erros)
  - DotEnv (Variáveis de ambiente)
  - Illuminate/Database (ORM)

- Docker

  - MySQL
  - Apache
  - PHP 7.2

## Ambiente

### Docker
```bash
sh .bin/exec.sh
```

## Testes

### Unitários

```bash
docker exec yofit_php composer test.integration.modules.gym
```
### Integração

```bash
docker exec yofit_php composer test.unit.modules.gym
```

## Contribuintes

1. [Jonathan Alves Gomes](https://github.com/jonathangomes17)
