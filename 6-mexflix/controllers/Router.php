<?php

    class Router {
        public $route;
        
        public function __construct($route){
            // Creando la session
            // https://www.php.net/manual/es/session.configuration.php
            // Buscar opciones en el PHP.INI
            $session_options = array(
                // 'use_only_cookies' => 1,
                // 'auto_start' => 1,
                // 'read_and_close' => true
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
                $this->route = isset($_GET['r']) ? $_GET['r'] : 'home';
                $controller = new ViewController();

                switch ($this->route) {
                    case 'home':
                        $controller->load_view('home');
                        break;

                    case 'movies':
                        $controller->load_view('movies');
                        break;
                    
                    case 'usuarios':
                        $controller->load_view('users');
                        break;

                    case 'status':
                        if (!isset($_POST['r'])) {
                            $controller->load_view('status');
                        } else if ($_POST['r'] == 'status-add') {
                            $controller->load_view('status-add');
                        } else if ($_POST['r'] == 'status-edit') {
                            $controller->load_view('status-edit');
                        } else if ($_POST['r'] == 'status-delete') {
                            $controller->load_view('status-delete');
                        }
                        break;
                    
                    case 'salir':
                        $user_session = new SessionController();
                        $user_session->logout();
                        break;
                    
                    default:
                        $controller->load_view('error404');
                        break;
                }

            } else {
                // Mostrar un formulario de autenticacion
                if (!isset($_POST['user']) && !isset($_POST['password'])) {
                    $login_form = new ViewController();
                    $login_form->load_view('login');
                } else {
                    // echo 'Estamos aqui';
                    $user_session = new SessionController();
                    $session = $user_session->login($_POST['user'], $_POST['password']);

                    if (empty($session)) {
                        // echo 'Credenciales Incorrectas';
                        $login_form = new ViewController();
                        $login_form->load_view('login');
                        header('Location: ./?error=Credenciales Incorrectas');
                    } else {
                        // echo 'Bienvenido al sistema';
                        // var_dump($session);
                        $_SESSION['ok'] = true;

                        foreach($session as $row) {
                            $_SESSION['user'] = $row['user'];
                            $_SESSION['email'] = $row['email'];
                            $_SESSION['name'] = $row['name'];
                            $_SESSION['birthday'] = $row['birthday'];
                            $_SESSION['password'] = $row['password'];
                            $_SESSION['role'] = $row['role'];
                        }

                        // ruta home
                        header('Location: ./');
                    }
                }

            }
        }

        public function __destruct() {
            // unset($this);
        }
    }