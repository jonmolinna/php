<?php

    print('
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link rel="stylesheet" href="./public/css/mexflix.css">
            <script src="https://cdn.tailwindcss.com"></script>
        </head>
        <body>
        
            <header class="container mx-auto flex justify-between py-3 items-center shadow-md">
                <div class="">
                    <h1 class="logo">Mexflix</h1>
                </div>
    ');

    if ($_SESSION['ok']) {
        print('
            <nav>
                <ul class="flex items-center space-x-4">
                    <li class="nobollet item menu"><a href="./">Inicio</a></li>
                    <li class="nobollet item menu"><a href="movies">Movies</a></li>
                    <li class="nobollet item menu"><a href="usuarios">Usuarios</a></li>
                    <li class="nobollet item menu"><a href="status">Status</a></li>
                    <li class="nobollet item menu"><a href="salir">Salir</a></li>
                </ul>
            </nav>
        ');
    };

    print('
        </header>
        <main class="container mx-auto">
    ');