# Candidato

**Nome**: Cássio Vinícius Bueno

**Email**: cassioleguizamonbueno@gmail.com

# Pré-requisitos
1) PHP 7.4 
2) Composer
3) Mysql

# Instalação
1) Baixar os arquivos /academia; 
   

    git clone [caminho do projeto]


2) Executar o comando abaixo para instalar as dependencias do projeto 
   

    composer install
    

3) Criar / Alterar o arquivo .env na raiz do projeto com informações do banco de dados do projeto


    PROJECT_NAME="Projeto Academia" 
    DB_HOST="localhost"
    DB_USER="root"
    DB_PASS=""
    DB_BASE="academia"
    DEBUG="false"

    BASE_URL="/academia"
    BASE_PATH="/htdocs/projetos/academia"

4) Executar o script de banco de dados


    CREATE DATABASE academia;    
    
Importar o arquivo dentro do mysql

    academia.sql

5) Rodar o projeto com PHP com servidor embutido


    php -S localhost:9092 
 
6) Executar no navegador 


    http://localhost:[porta]  ou  http://localhost


# Observações

Usuário com perfil Administrador

    e-mail: fumuca@gmail.com
    senha: 1234

Usuário com perfil Aluno Usuário 

    e-mail: teste2@teste.com
    senha: 1234


***
IMPORTANTE: No nome do usuário no topo da página, encontra-se o menu que leva a área administrativa do projeto. 
