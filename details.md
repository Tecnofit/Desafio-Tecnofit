# Candidato

**Nome**: Alexandra Ferrari

**Email**: alexandra.ferrari@tecnofit.com.br

# Requisitos:

- PHP
- Composer: https://getcomposer.org/download/
- Laravel

Para instalar o Laravel, executar o comando:

```
composer global require laravel/installer
```

Para executar:
- Criar um arquivo .env com os dados para conexão com o banco de dados, conforme exemplo no arquivo .env_example;
- No diretório do projeto (controle-treinos), executar o comando para instalar as dependências:
```
  composer install
```
- Executar o comando para criar as tabelas no banco de dados:
```
  php artisan migrate
```
- Executar o comando para rodar a aplicação:
```
  php artisan serve
```



# Observações

Rotas API:

# Alunos

``` GET /api/students ```: Retorna os alunos cadastrados.

``` GET /api/students/{id} ```: Retorna o aluno cadastrado associado ao id.

``` GET /api/students/{id}/workouts ```: Retorna os treinos do aluno.

``` POST /api/students/create ```: Cadastrar aluno.
Requisição exemplo:

```
  {
    "name": "Amanda",
    "email": "email@email.com",
    "age": "18",
    "address": "Endereço",
    "notes": "observações"
  }
```
Apenas o campo "name" é obrigatório.

Resposta:
```
  {
    "name": "Amanda",
    "email": "email@email.com",
    "age": "18",
    "address": "Endereço",
    "notes": "observações",
    "updated_at": "2020-01-03 02:24:39",
    "created_at": "2020-01-03 02:24:39",
    "id": 1
  }
```

``` PUT /api/students/{id} ```: Atualiza os dados do aluno.

Requisição exemplo:

```
  {
    "name": "Amanda",
    "email": "email@email.com",
    "age": "18",
    "address": "Endereço",
    "notes": "observações"
  }
```

``` DELETE /api/students/{id} ```: Remove o aluno.

# Treinos

``` GET /api/workouts/{id} ```: Retorna o treino cadastrado associado ao id.

``` POST /api/workouts/create ```: Cadastrar treino.

Requisição exemplo:

```
  {
    "name": "Treino",
    "student_id": 4,
    "active": true,
    "exercices": [
      {
        "id_exercice": 8,
        "series": 15
      },
      {
        "id_exercise": 1,
        "series": 20
      }
    ]
  }
```
Os campos "name", "student_id" e "exercices" são obrigatórios.

Resposta:
```
  {
    "name": "Treino",
    "student_id": 4,
    "active": true,
    "updated_at": "2020-01-02 23:37:53",
    "created_at": "2020-01-02 23:37:53",
    "id": 1
  }
```

``` PUT /api/workouts/{id} ```: Atualizar treino.

Requisição exemplo:

```
  {
    "name": "Treino",
    "student_id": 4,
    "active": true,
    "exercices": [
      {
        "id_exercice": 8,
        "series": 15
      }
    ]
  }
```
Os campos "name", "student_id" e "exercices" são obrigatórios. O array "exercices" é recriado.

Resposta:
```
  {
    "name": "Treino",
    "student_id": 4,
    "active": true,
    "updated_at": "2020-01-02 23:37:53",
    "created_at": "2020-01-02 23:37:53",
    "id": 1
  }
```

``` DELETE /api/workouts/{id} ```: Remove o treino.

``` GET /api/workouts/{id}/exercices ```: Retorna os exercícios associados ao treino com id.


# Exercícios

``` GET /api/exercices/ ```: Retorna todos os exercícios cadastrados. 

``` GET /api/exercices/{id} ```: Retorna o exercício associado com o id. 

``` POST /api/exercices/create ```: Cadastrar exercício.

Requisição exemplo:

```
  {
    "name": "Jump",
  }
```
O campo "name" é obrigatório.

Resposta:
```
{
    "name": "Jump",
    "updated_at": "2020-01-03 02:51:30",
    "created_at": "2020-01-03 02:51:30",
    "id": 1
}
```
``` PUT /api/exercices/{id} ```: Atualizar o exercício.

Requisição exemplo:

```
  {
    "name": "Jump 20",
  }
```
O campo "name" é obrigatório.

Resposta:
```
{
    "name": "Jump 20",
    "updated_at": "2020-01-03 02:51:30",
    "created_at": "2020-01-03 02:51:30",
    "id": 1
}
```

``` DELETE /api/exercices/{id} ```: Remove o exercício.
