<?php

    class Router {
        public $route;
        
        public function __construct($route){
            // Creando la session
            // https://www.php.net/manual/es/session.configuration.php
            // Buscar opciones en el PHP.INI
            $session_options = array(
                'use_only_cookies' => 1,
                // 'auto_start' => 1,
                'read_and_close' => true
            );

            if (!isset($_SESSION)) {
                session_start($session_options);
            }
            
            if (!isset($_SESSION['ok'])) {
                // Creando la variable ok 
                $_SESSION['ok'] = false;
            }

            if ($_SESSION['ok']) {
                // Aqui va toda la programacion de nuestra web
            } else {
                // Mostrar un formulario de autenticacion
                $login_form = new ViewController();
                $login_form->load_view('login');
            }
        }

        public function __destruct() {
            // unset($this);
        }
    }