# Candidato

**Nome**: Rodrigo Cirino de Andrade

**Email**: rodrigorcandrade@gmail.com

# Tecnologias

| Tech        | Version           | 
| ------------- |:-------------:| 
|   PHP |   7.4 |
|   PHPUnit |   9.4 |
|   Composer    | 2.0.6    |
|   MySQL   |   8.0.22    |

# Instalação

Sugestão usar o **MySQL rodando no Docker**

```shell script
    
    # Docker running Mysql database

    cmd > docker run --name mysql-docker -p 3306:3306 -e MYSQL_ROOT_PASSWORD=root mysql
    
    cmd > docker ps
    
    cmd > docker exec -it mysql-docker bash
    
    root@00000:/# mysql -u root -p
    
    mysql> show databases
    
    mysql> CREATE DATABASE academia;
```

Constates para conexão com o banco de dados estão no arquivo ***/src/constants.php***

Criar as tabelas do banco de dados usando **/src/export-database.sql**

Para executar o projeto utilize a classe **/src/Tests/TestAcademia.php** rodando via PHPUnit Runner.

Projeto foi criado usando TDD com o conceito de *'Baby Steps'*.


