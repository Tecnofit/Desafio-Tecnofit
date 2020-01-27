# Candidato

**Nome**: Ricardo Luciano Feijó Correa

**Email**: ricardolucianofc@gmail.com

# Instalação
- O diretório `Ricardo-Correa` deverá ser colocado no caminho **\htdocs**
+ O arquivo `db_ricardo_correa.sql` é o arquivo que possui o **schema + data** *(dados de exemplos)* da base de dados que deverá ser utilizado.

+ Para a importação poderá ser utilizado o [**phpMyAdmin**](http://localhost/phpmyadmin/)
	+ Crie uma base de dados chamada: *db_Ricardo_Correa*
	+ Abra a base [criada](http://localhost/phpmyadmin/db_structure.php?db=db_ricardo_correa) e clique na aba **Importar**, escolha o arquivo `db_ricardo_correa.sql` e clique em **Executar**.

- Caso você tenha optado em realizar os testes em algum MySQL já previamente instalado, favor ir em **\htdocs\Ricardo-Correa** e editar as configurações arquivo `db_connect.asp` conforme necessário.
```html
	$localhost = "localhost"; 
	$username = "root"; 
	$password = ""; 
	$dbname = "db_ricardo_correa"; 
```
- Acesse o [site](http://localhost/Ricardo-Correa/index.php)  utilizando o login **admin** e senha: *0000*  (módulo administrador) para criar, alterar e excluir alunos, treinos e exercícios.
- Como já existem dados de exemplo, pode realizar uma simulação de aluno utilizando o login **barry@starlabs.net** e senha: *1234* 		
	+ *Modo de senha não implementado: Todos os alunos são criados com senha 1234*

# Observações
- Tecnologias utilizadas:
	**Necessário:** Apache + MySQL
	* Linguagens PHP
	* HTML e CSS
	* Biblioteca jQuery
