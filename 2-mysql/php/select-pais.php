<?php

    if (!$registro_contacto["pais"]) {
        include "conexion.php";
    }

    $query = "SELECT * FROM pais ORDER BY pais";
    $data = $connection->query($query);

    foreach ($data as $country) {
        $name_country = $country['pais'];
        $data = utf8_decode($registro_contacto['pais']);
        echo "<option value='$name_country'";
        if ($registro_contacto['pais'] ?? null) {
            if ($name_country == $data) {
                echo " selected";
            }
        }
        echo ">$name_country</option>";
    }
?>