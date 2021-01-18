<?php
$menu_ativo = str_replace("/", "", $_SERVER["PHP_SELF"]);
?>
<div class="well sidebar-nav">
    <ul class="nav nav-list">
        <li class="<?=(($menu_ativo == 'ger-usuarios.php' ) ? "active" : "")?>"><a href="ger-usuarios.php">Alunos</a></li>
        <li class="<?=(($menu_ativo == 'ger_treino_usuario.php') ? "active" : "")?>"><a href="ger-treino-usuario.php">Meus Treinos</a></li>
        <li class="<?=(($menu_ativo == 'ger-exercicios.php' ) ? "active" : "")?>"><a href="ger-exercicios.php">Exercícios</a></li>
        <li class="<?=(($menu_ativo == 'ger_treino_usuario.php') ? "active" : "")?>"><a href="ger-treino-usuario.php">Meus Treinos</a></li>
    </ul>
</div>
