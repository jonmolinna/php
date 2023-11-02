<?php

    require_once('StatusModel.php');

    class StatusController {
        private $model;

        public function __construct() {
            $this->model = new StatusModel();
        }

        public function create($body = array()) {
            return $this->model->create($body);
        }

        public function read($id = '') {
            return $this->model->read($id);
        }

        public function update($body = array()) {
            return $this->model->update($body);
        }

        public function delete($id = '') {
            return $this->model->delete($id);
        }

        public function __destruct() {
            // unset($this);
        }
    }