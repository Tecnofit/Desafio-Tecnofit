# Candidato

**Nome**: Eduardo Karpowicz

**Email**: eduardo.karpowicz@tecnofit.com.br

# Instalação
- **Endereço localhost:** 127.0.0.1:3308

- **Database:** login
  - User: root
  - Senha: 12345
  
- **Database:** academiajedi
  - User: root
  - Senha: 12345

# Observações
- Linguagem utilizada: PHP
- Banco de dados utilizado: MySQL 
- Ferramenta de banco de dados utilizada: MySQL Workbench
- Servidor local utilizado: Apache
- Framework CSS utilizado: Bulma.io

- Criei duas databases: Uma exclusiva para os dados de login (**login**) e outra para os demais dados (**academiajedi**).
- Na primeira página (**index.php**), é necessário clicar em **Cadastrar** para efetuar o cadastro do usuário do sistema (no caso, o funcionário). Se o cadastro for concluído, o sistema irá mostrar uma mensagem de **"Cadastro efetuado com sucesso"** e apresentará uma opção para retornar a tela de login. Digitando os dados corretamente, o sistema irá redirecionar para a página **painel.php**. Caso os dados digitados estejam incorretos, o sistema mostrará uma mensagem de **Erro: Usuário não localizado.**.
- Ao acessar o sistema, o funcionário poderá **cadastrar, ler, alterar ou excluir (CRUD)** tanto **Alunos** quanto **Exercícios**.
- No cabeçalho, temos os menus **Alunos, Treinos e Exercícios**, além dos botões **Área do Aluno** e **Sair**.
- Clicando em **Área do Aluno** o funcionário será redirecionado para uma página de validação de dados utilizada em terminais. Será possível fazer com que esta tela fique disponível para os alunos em um terminal. Informando o **Código do aluno** e **E-mail**, o aluno poderá selecionar seu treino.
- Clicando em **Sair**, o funcionário encerrará a sua sessão no sistema.

Obs: Por motivos de estar retornando a programação, não tive tempo hábil para efetuar as solicitações referentes a **Treinos**. Portanto, o menu **Treinos** estará vazio e a **Área do Aluno** não irá apresentar nenhum treino para o aluno selecionar. Mas pretendo dar sequência ao desenvolvimento após a entrega de parte do projeto.
