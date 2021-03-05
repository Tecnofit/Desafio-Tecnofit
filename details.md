# Candidato

**Nome**: Fernando Gurkievicz
**Email**: fergkz@gmail.com

# Instalação
Deve ser utilizado o docker para instanciar os containers, com os softwares nas seguintes versões:
```
Docker version 20.10.2, build 2291f61
docker-compose version 1.27.4, build 40524192
```
Obs: O sistema não foi testado em outras versões Docker e sistemas operacionais

Executar o seguinte comando docker-compose: 
```
$ docker-compose up --build
```

# Execução

Para acessar o sistema, basta acessar [http://localhost/](http://localhost/) do seu navegador com o seguinte usuário:
```
e-mail: admin@admin.com
senha: tecnofit
```
Para demais usuáriors (alunos ou administradores), deve ser cadastrado no sistema via painel.
Obs: Como o ACL é feito via JWT e sendo interpretado pelo front-end (com expiração de 1h), sempre que houver troca de perfil ou alteração nos dados base de um usuário (nome, email, login, perfil) é necessário logar novamente, ou esperar a expiração do JWT, onde o front-end irá forçar o usuário a se relogar.

Na raiz deste projeto, existe um arquivo chamado `details-api-collection-postman.json` com o import das APIs para o postman, caso desejem testar individualmente, porém, não se faz necessário.

# Ferramentas externas utilizadas
Foram utilizadas as seguintes ferramentas/bibliotecas nas versões:
> - `jquery.js 3.5.1` *Biblioteca JS para facilitar a manipulação do DOM*
> - `jquery.mask.js v1.14.16` *Biblioteca JS para formatação de campos*
> - `bootstrap 5.0.0-beta2` *Biblioteca bootstrap para padronização de layout*
> - `bootstrap-icons 1.4.0` *Biblioteca bootstrap de ícones*
> - `PHP v7.4+` *Linguagem utilizada para desenvolvimento backend*
> - `ramsey/uuid 4.1` *Biblioteca PHP para geração e validação de UUID*
> - `vlucas/phpdotenv 3.9` *Biblioteca PHP para leitura de configurações de arquivo .env*
> - `ongodb/mongodb 1.5.2` *Biblioteca PHP para manipulação do banco de dados mongodb*
> - `rbdwllr/reallysimplejwt 4.0` *Biblioteca PHP para geração, leitura e validação de JWT*

# Arquitetura
Idealizei quebrar o sistema em 3 partes para manter melhor o controle de segurança de acesso e principalmente escalabilidade e qualidade de software:
> - `Sistema Portal`: Aplicação front-end independente e estática com alta escalabilidade
> - `Sistema ACL`: Aplicação back-end responsável por gerenciar cadastro e acesso de usuários
> - `Sistema Gym`: Aplicação back-end responsável por gerenciar cadastro de treinos, exercícios e regras de negócio

Para o front-end, estou utilizando html puro com conexões via API e bootstrap.
Para o backend, estou utilizando PHP puro sob a arquitetura hexagona/ports and adapters, para facilitar a migração de tecnologia e separação das responsabilidades dentro do código.

O sistema foi idealizado para rodar em ambientes clusterizados, com múltiplos containers, facilitando a escalabilidade.
> - `Container "portal"`: Responsável por manter o front-end independente das aplicações backend
> - `Container "acl-webserver"`: Responsável por gerenciar as conexões com o sistema de gerenciamento de usuários
> - `Container "acl"`: Responsável por gerenciar a execução do código sistema de gerenciamento de usuários
> - `Container "acl-composer"`: Responsável por manter atualizadas as biblitecas do sistema de gerenciamento de usuários
> - `Container "gym-composer"`: Responsável por manter atualizadas as biblitecas do sistema de treinos
> - `Container "gym-webserver"`: Responsável por gerenciar as conexões com o sistema de treinos
> - `Container "database"`: Responsável por manter o banco de dados mongodb para os sistemas

# Não contemplado no projeto
- Não foi feito um framework para atender ao front-end, visando tempo de desenvolvimento e escalabilidade imediata
- Não foram feitos tratamento de layout como mensagem de erros, avisos e afins customizadas, sendo limitado ao elementos padrões do HTML
- Ainda no layout, não foram feitos tratamentos de carregamento (efeito visual para o usuário), delays e melhor tratativas de resposta ao toque dos botões
- No back-end, pulei algumas validações básicas visando o caminho feliz, então, algumas mensagens pode estar com o default de validação da aplicação
- Não foi feito nenhum tratamento de paginação para as APIs e front-end, sendo assim, sempre irá listar todos os dados quando a página conter uma listagem
- Algumas validações de acesso a páginas não foram testadas, então, provavelmente um Q.A. alertaria na fase de homologação de teria que ser corrigido.
- Para o sistema de ACL, não coloquei nenhuma validação para demonstrar uma aplicação sendo bloqueada e a outra não, porém, simplesmente podemos copiar a lógica aplicada no sistema GYM.

# Observações
Qualquer dúvida, pode me contactar nos seguintes canais:
**Phone/Whatsapp:** +55 (041) 99646-9660
**E-mail:** fergkz@gmail.com

Peço desculpas pelo atraso na entrega, comecei na terça-feira a noite e só executei em horário noturno.
Qualquer dúvida, pode me contactar a momento por e-mail/whats.

Obrigado!