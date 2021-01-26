# Requisitos
Instalar docker-compose 
Instalar Angular

Entrar no diretório pricipal do procedo e executar:

```
sudo chown $USER /var/run/docker.sock
```

Em seguida, executar:

```
docker-compose up -d
```
Acessar  a pasta do frontend

```
cd front
```

instalar as depencências com o comando:
```
npm install
```
Logo após, iniciar o servidor:
```
ng serve
```


# Docker
Foram configurados 3 dockers que vão executar:

```
Apache, MySql 8.0, PhpMyAdmin and Php
```

Para abror o phpmyadmin utilize a URL [http://localhost:8000](http://localhost:8000)
Para abrir o servidor web com o backend, executar(segundo URIs configuradas) [http://localhost:8001](http://localhost:8001)

Caso querira entrar no mysql via linha de comando, executar:


- `docker-compose exec db mysql -u root -p`



URL do FrontEnd
http://localhost:4200/

Exemplo da api backend
http://localhost:8001/api/aluno/read.php
