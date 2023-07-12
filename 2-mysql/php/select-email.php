<?php

    // Incluye el archivo de la conexion a la BD
    include("conexion.php");

    $query = "SELECT email FROM contactos ORDER BY email";

    $data = $connection->query($query);

    foreach($data as $email) {
        echo "<option value='".$email["email"]."'>".$email["email"]."</option>";
    };

    $connection->close();

?>