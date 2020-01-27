<?php
session_start();
include_once("incHeader.php");
?>

<form method="post" id="frmLogin" name="frmLogin" action="login.php">
	<div class="container">
    <div class="box">
      <h2>Ricardo Correa Test</h2>
      <label for="txtLogin">Login ou E-mail</label><br />
      <input type="text" placeholder="Digite seu login ou e-mail" name="txtLogin" required><br />
      <br />
      <label for="txtPwd">Password</label><br />
      <input type="password" placeholder="Sua senha" name="txtPwd" required><br />
    
      <button type="submit">Entrar</button>
      <p><address>
        <ul>
        <li>Login: admin / senha: 0000</li>
        <li>Todos alunos possuem a senha: 1234</li>
        </ul>
</address></p>
    </div>
  </div>
</form>

<?php include_once("incFooter.php"); ?>


