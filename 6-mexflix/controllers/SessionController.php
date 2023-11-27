<?php

    class SessionController {
        private $session;

        public function __construct() {
            // echo 'Hola Mundo <<<<<';
            $this->session = new UsersModels();
        }

        public function login($user, $password) {
            return $this->session->validate_user($user, $password);
        }

        public function logout() {
            session_start();
            session_destroy();
            header('Location: ./');
        }

        public function __destruct() {
            // unset($this);
        }
    }