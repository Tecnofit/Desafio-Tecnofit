# Candidato

**Nome**: Marco Falcão

**Email**: maffalcao@gmail.com

# Vídeo de demonstração (assistir antes de seguir):

- https://www.awesomescreenshot.com/video/3573739?key=bd41c715e2935043ebff7ab8f297d100

# Tecnologias utilizadas

- PHP 7.2 
- Mysql 

# Instalação 

1. Para configurar a conexão com o banco de dados, edite o arquivo presente em db/config.ini e atribuia às variáveis valores para: 

- host: localhost caso o mysql esteja instalado na mesma máquina
- username: nome de usuário com privilégios de conexão ao banco
- password: senha utilizada pelo usuário informado anteriormente
- dbname: deve ser criada uma base de dados específica para criação das tabelas

2. Para criação das tabelas, copiar e executar, tendo selecionado a base de dados informada na configuração anterior, as instruçõe SQL presentes no arquivo db/schema.sql 

3. Caso queira popular as tabelas com dados iniciais que tornam os testes mas reais, copiar e executar as instruções as instruções SQL presentes no arquivo db/data.sql

# Observações

No front, a aplicação usou à risca o conceito de SPA. Usei angularJS para possibilitar o dinamismo e controle necessário aos componentes

No back, sem ajuda de nenhum framework, adaptei um ORM simples para me permitir criar models que encapsulam os conceitos de save, delete, getAll, findById, entre outros. Com o ORM primitivo aplicado aos models, criei um roteamento das requisições do front que me permitiram delegar para a classe especifica processar suas solicitações.

A estruturação da base de dados para receber o desafio é conforme resumido abaixo:

- students: estudantes
- exercises: exercicios
- trainings: treinos
- trainingExercises: vinculo exercícios a treinos
- studentTraining: vínculo de treinos a alunos
- studentTrainingExercise: vínculo de itens de treinos a alunos










