<?php

    if ($_POST["usuario_txt"] == "dallas" && $_POST["password_txt"] == "123") {
        // Inicio la session
        session_start();

        // Declaro mis variables de session
        $_SESSION["autentificado"] = true;
        $_SESSION["usuario"] = $_POST["usuario_txt"];

        header("Location: 7-archivo_protegido.php");
    } else {
        header("Location: 7-principal.php?error=si");
    }


?>