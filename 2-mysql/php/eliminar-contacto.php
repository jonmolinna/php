<?php
    include("conexion.php");

    $email = $_POST["email_slc"];

    $delete = "DELETE FROM contactos WHERE email = '$email'";
    $mysql = $connection->query($delete);

    if($mysql) {
        $mensaje = "Se elimino el contacto";
    } else {
        $mensaje = "El contacto no se pudo eliminar";
    }

    $connection->close();

    header("Location: ../index.php?op=baja&mensaje=$mensaje");


?>