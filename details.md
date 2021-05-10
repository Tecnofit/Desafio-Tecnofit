# Candidato

**Nome**: Hiago Alves Klapowsko

**Email**: hiagoklapowsko@gmail.com

# Instalação
1. Para rodar este projeto é necessário primeiro estar com o **docker** e o **docker-compose** instalado em sua maquina.
2. Dentro da pasta do projeto executar o seguinte comando :
   `docker-compose up` .
   Com isso será iniciado os containers do sistema.
3. Com os containers rodando é necessário importar o banco :
   `docker exec -it tecnofit-mysql bash`
   e após isso:
   `mysql -u professor -p academia_tecnofit < tecnofitsql.sql`
4. Já podemos acessar o sistema: http://localhost:8080.

## Acessos ao banco:
  	    - MYSQL_ROOT_PASSWORD= root
        - MYSQL_DATABASE= academia_tecnofit
        - MYSQL_USER= professor
        - MYSQL_PASSWORD= tecnofit

# Observações
Para este projeto utilizei as seguintes tecnologias: **Docker**, **PHP** e para montar o front-end utilizei o **Admin LTE** como dashboard do sistema. Enfim espero que gostem, qualquer dúvida estou a disposição :fa-smile-o: !
