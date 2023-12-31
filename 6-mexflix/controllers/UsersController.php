<?php

    class UsersController {
        private $model;

        public function __construct() {
            $this->model = new UsersModels();
        }

        public function set($body = array()) {
            return $this->model->set($body);
        }

        public function get($id = '') {
            return $this->model->get($id);
        }

        public function delete($id = '') {
            return $this->model->delete($id);
        }

        public function __destruct() {
            // unset($this);
        }
    }