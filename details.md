# Candidato

**Nome**: Alan Duarte dos Santos

**Email**: alanduartes@gmail.com

# Instalação
- Clone o repositório. _(Meu branch é o: **alan-santos**)_
- Eu utilizei o famoso XAMPP(inho) e uma máquina Windows
    - Criei uma entrada para VirtualHost no arquivo httpd.conf do Apache com a pasta public como root do projeto
    ```
    <VirtualHost *:80>
        DocumentRoot "C:\xampp\htdocs\tecno/public
        ServerName alan.tecno
    </VirtualHost>
    ```
    - Em _C:\Windows\System32\drivers\etc\hosts_ fiz o seguinte mapeamento para o projeto
    ```127.0.0.1   alan.tecno```
- Em ```/back/conf/database.php``` está a configuração do banco de dados, preencha com os dados do seu banco
    - E falando em banco em ```public/init``` tem um arquivo chamado **db.sql** que tem instruções para criar o **usuário** e suas **permissões**, o **banco de dados** e alguns inserts iniciais e as **tabelas**
- Navegue até a pasta do projeto recém clonado e rode o comando:
```$ composer install```
esse comando irá fazer os mapeamentos dos arquivos pelo autoloader
- Depois disso seguindo esse passo-a-passo acima é só acessar http://alan.tecno e a página inicial já deverá aparecer

# Sobre a ativação de treinos
- Para ativar um treino deverá ser acessado  a edição de usuário e selecionado um treino em **Active Training**

# Observações
"Sempre" que faço um teste técnico para entrevista eu invento de fazer com algo que ainda não tenho tanto contato.
Dessa vez utilizei uma arquitetura **Rest** onde isolei o Front do Back. A ideia é sempre que o front precise de algo do servidor, deverá ser enviada uma requisição POST, GET ou DELETE ( Tive um problema com PUT no PHP pois nunca mexi e não quis investir muito tempo nisso pois investi muito tempo pensando e implementando o funcionamento da arquitetura).

- Criei um arquivo ```public/api.php``` que contempla as rotas, classe e método que irá tratar aquela requisição
- As páginas HTMl estão todas em ```public/```
- Cada página tem seu próprio JS que começa com **page**-<nome-da-página>.js
    - Esse js além de manter as funcionalidades de cada tela, também renderiza o conteúdo do HTML referente a página
- ```resources/js/lib``` contém os arquivos js que irão fazer as requisições para o back e retornar um json para ser manipulado no front

Eu iniciei o desenvolvimento utilizando o conceito de mobile first, mas como eu fico ansioso em terminar esses testes acabei não dando foco na responsividade, logo, fica melhor em tela pequena.
