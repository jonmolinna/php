<?php include("7-sessiones.php"); ?>

Bienvenido:

<?php echo $_SESSION["usuario"]; ?>
<br><br>

Estas en una pagina segura con sessiones en PHP
<br><br>

<a href="7-archivo_protegido2.php">Ir a otra pagina segura</a>
<br><br>

<a href="7-salir.php">Salir</a>