# Candidato

**Nome**: Marcos Paulo Alves Martins

**Email**: marcos.martins@tecnofit.com.br

# Instalação
Primeiro realize o download do program Xampp pelo link https://www.apachefriends.org/pt_br/download.html, procure qual melhor se adequa ao seu computador.
Depois de instalado o Xampp execute ele e inicie o Apache e o MySQL clicando em "Start"
(OBS: precisei ligar o Apache no Xampp, apesar do PHP possuir um servidor próprio, não consegui acessar o phpMyAdmin sem ligar ele)
Depois de ligar o Apache e o MySQL agora é hora de criar a base de dados que vai receber as tabelas, para isso acesse o seguinte endereço http://localhost/phpmyadmin/
Crie uma base de dados com o nome de "desafiotecnofit".
Depois de criar a base de dados agora é hora de importar a estrutura da base com o arquivo "desafiotecnofit.sql".
Para isso clique na base de dados "desafiotecnofit" e na parte superior da tela da base procure pelo botão de importar, selecione o arquivo e clique em Executar.
(OBS2: Criei alguns exemplos e deixei neste arquivo "desafiotecnofit.sql" caso deseje excluir os dados de exemplo, pode fazer pela aplicação)

Agora para realizar a instalação e rodar a aplicação será necessário fazer o download do arquivo ou clonar o projeto do GIT(Branch com nome de Marcos-Martins).
1-> Em caso de download, descompacte o arquivo em uma pasta de sua preferencia.
2->Abra o prompt de comando(CMD), pressione as teclas CTRL+Windows e na janela de executar digite "CMD"
3->No prompt acesse a pasta aonde descompactou o arquivo, caso necessite voltar alguma pasta pode fazer com o comando cd .. 
4->quando estiver na pasta do arquivo, digite o seguinte comando "php artisan serve" assim ligamos o servidor para rodar a aplicação.
5->Agora basta acessar a aplicação em si, para isso acesse no navegador "localhost:8000




# Observações
Projeto está incompleto, faltando alguns requisitos.

Aluno
Cadastrar aluno = OK
Editar aluno = OK
Remover aluno = OK
Perfil do aluno exibindo o treino ativo = Exibe os treinos, independente se está ativo ou não, preciso melhorar a funcionalidade.

Exercícios
Cadastrar exercício = OK
Editar exercício = OK
Remover exercício = OK


Treinos
Cadastrar treino = OK
Editar treino = Não realizado
Ativar treino = Você consegue setar se o treino/ficha está ativo ou intativo, porém você pode ter mais de um treino ativo.


Premissas
Ao cadastrar um novo exercício ao treino, será necessário informar quantas sessões deverá ser feita = OK
O exercício só poderá ser deletado se o mesmo não estiver presente em um treino ativo = Não realizado
O aluno poderá marcar o exercício como finalizado, ou ter a opção de "pular" o exercício = Não realizado
Só deve existir um treino ativo por aluno = Não realizado
