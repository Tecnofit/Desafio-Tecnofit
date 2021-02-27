# Candidato
**Nome**: Leandro Alves Ivanaga

**Email**: leandro.ivanaga@gmail.com

# Tecnologias
PHP, Mysql, jQuery, JS, CSS, HTML


# Instalação
**1 -** Alterar o caminho ("Directory") no arquivo "desafio-tecnofit.conf" (localizado na raiz do projeto), conforme o diretório que o projeto estiver localizado ;

**2 -** Copiar o arquivo "desafio-tecnofit.conf" para a pasta de configurações do apache /etc/apache2/sites-enabled/ ;

**3 -** Reiniciar o apache ;

**4 -** Criar um banco de dados para ser utilizado no projeto. Exemplo: CREATE DATABASE desafio_tecnofit_leandro_ivanaga ;  

**5 -** Criar um usário para acessar o banco criado anteriormente. Exemplo: CREATE USER 'desafio_ivanaga'@'localhost' IDENTIFIED BY 'tecnofit'  ;  

**6 -** Liberar permissão do usuário ao banco criado. Exemplo: GRANT ALL PRIVILEGES ON desafio_tecnofit_leandro_ivanaga.* TO 'desafio_ivanaga'@'localhost' ;

**7 -** Alterar as configurações do acesso ao banco de dados criado no arquivo ".config" (localizado na raiz do projeto) ;

**8 -** Dentro do banco criado, executar os scripts do arquivo "tables.sql" (localizado na raiz do projeto) para criar as tabelas e um usuário inicial ao sistema .


# Observações
Necessário que o Mod_Rewrites do apache esteja ativado, para funcionamento correto do roteamento e url amigáveis.

Comando para habilitar: sudo a2enmod rewrite


# Acessos
Após realizar a instalação e configuração do projeto. Será criado um usuário ADMIN.

Dados de acesso:

**login**: admin

**senha**: pass

# Perfils de Acessos
**ADMIN**

Pode gerenciar atletas, treinos e exercícios.

Pode adicionar e remover treinos aos atletas.

Pode adicionar e remover exercícios aos treinos.


**Atleta**

Pode ativar um treino.

Pode concluir uma sessão de exercício.

Pode finalizar ou pular um exercício.