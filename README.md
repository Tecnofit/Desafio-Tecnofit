![Tecnofit](https://s3-sa-east-1.amazonaws.com/tecnofit-pub/app/01_200px.png)

O desafio consiste em criar uma aplicação que gerencie os treinos de uma academia.

## Instruções para rodar o sistema
---
## Subindo o Docker para rodar o app
1. **sudo docker-compose build app**
2. **sudo docker-compose up -d**
3. ![Título da imagem](public/img/rodar-docker.png)

---
## Instalar as dependências do composer
4. **sudo docker-compose exec app composer install**
4.0. ![Título da imagem](public/img/composer.png) 

## atualizando as dependêbcuas
4.1. **sudo docker-compose exec app composer update**

---

## crie uma chave para o artisan
5. **sudo docker-compose exec app php artisan key:generate**
5.1. ![Título da imagem](public/img/key-generate.png) 

---

## Verifique o host do mysql que o Docker gerou

Comando no terminal:

6.0. **docker ps**

![Título da imagem](public/img/docker-ps.png)


6.1. **docker inspect _id do mysql_**

![Título da imagem](public/img/docker-inspect.png)

6.3. Copie o numero do IPAddress 
* Ex:  _172.24.0.4_
---

## Edit o host do mysql
7. **Abra o arquivo database.php linha 49 e coloque o host que o docker gerou**

![Título da imagem](public/img/database.png)

---

7.1. **sudo docker-compose exec app php artisan migrate**

![Título da imagem](public/img/migrate.png)

---

8. Acesse o **_http://localhost:8000/_**

![Título da imagem](public/img/abertura.png)

---
9. Crie seu usuario e realize o login
![Título da imagem](public/img/cadastrar.png)

---

10. Na home verá os seguintes módulos:
![Título da imagem](public/img/tela-abertura.png)

---

11. Cadastre os alunos:
![Título da imagem](public/img/cadastrar-aluno.png)

---

12. Cadastre os exercicios:
![Título da imagem](public/img/cadastre-exercicio.png)

---

13. Cadastre os treinos:
![Título da imagem](public/img/cadastre-treino.png)

---

13. Ativar/Pular/Finalizar:
![Título da imagem](public/img/ativar-treino.png)

![Título da imagem](public/img/pular-treino.png)

![Título da imagem](public/img/finalizar-exercicio.png)

---

14. Ter o status do Aluno:
Entre no controle do aluno e selecione visualizar o (olho)

![Título da imagem](public/img/status-aluno.png)


## License
The MIT License (MIT). Please see [License File](LICENSE) for more information.

## Desenvolvido por: Paulo Antonio Vital
  
