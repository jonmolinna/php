<?php

    include "conexion.php";

    $query = "SELECT * FROM pais ORDER BY pais";
    $data = $connection->query($query);

    foreach ($data as $country) {
        echo "<option value='".$country["pais"]."'>".$country["pais"]."</option>";
    }
    
?>