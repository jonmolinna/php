<?php

    $name = "dallase";
    $password = "123as";

    if (isset($_GET["enviar_hdn"])) {
        if ($name === $_GET["name_txt"] && $password === $_GET["password_txt"]) {
            echo "<h2>Welcome</h2>";
            echo "Detalles <br />";
            echo "Nombre: ".$_GET["name_txt"]."<br />";
            echo "Contraseña: ".$_GET["password_txt"]."<br />";
            echo "Sexo: ".$_GET["sexo_rdo"];
        } else {
            header("Location: 4-validacion_datos.php?error=si");
        }
    } else if (isset($_POST["enviar_hdn"])) {
        if ($name === $_POST["name_txt"] && $password === $_POST["password_txt"]) {
            echo "<h2>Welcome</h2>";
            echo "Detalles <br />";
            echo "Nombre: ".$_POST["name_txt"]."<br />";
            echo "Contraseña: ".$_POST["password_txt"]."<br />";
            echo "Sexo: ".$_POST["sexo_rdo"];
        } else {
            header("Location: 4-validacion_datos.php?error=si");
        } 
    }

?>