<?php
define('HOST', '127.0.0.1:3308');
define('USER', 'root');
define('SENHA', '12345');
define('DB', 'login');

$conexao = mysqli_connect(HOST, USER, SENHA, DB) or die ('Não foi possível localizar este usuário.');




