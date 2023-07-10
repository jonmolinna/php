<?php

    function conectarse() {
        $servidor = "localhost";
        $user = "root";
        $password = "molina125";
        $db = "contactos_php";

        $connectar = new mysqli($servidor, $user, $password, $db);
        return $connectar;
    };

    $connection = conectarse();


?>