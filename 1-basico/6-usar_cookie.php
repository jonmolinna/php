<?php

    if (!$_COOKIE["idioma_solicitado"]) {
        header("Location: 6-pedir_idioma.php");
    } else if ($_COOKIE["idioma_solicitado"] == "es") {
        header("Location: 6-espaniol.php");
    } else if ($_COOKIE["idioma_solicitado"] == "en") {
        header("Location: 6-ingles.php");
    }


?>