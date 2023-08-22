<?php

    // Incluye el archivo de la conexion a la BD
    include("conexion.php");

    $query = "SELECT email FROM contactos ORDER BY email";

    $data = $connection->query($query);

    foreach($data as $email) {
        echo "<option value='".$email["email"]."'";
        if ($_GET["contacto_slc"] ?? null) {
            if ($_GET["contacto_slc"] == $email["email"]) {
                echo " selected";
            }
        }
        echo ">".$email["email"]."</option>";
    };

    // $connection->close();

?>