<?php

    $template = '
        <div class="">
            <h2>Hola %s, Bienvenido a Mexflix</h2>
            <h3>Tus peliculas y series favoritas</h3>
            <p>Tu Nombre es %s</p>
            <p>Tu Email es %s</p>
        </div> 
    ';

    printf(
        $template,
        $_SESSION['name'],
        $_SESSION['email'],
        $_SESSION['email'],
        $_SESSION['email']
    );