<?php

    require_once('Model.php');

    class StatusModel extends Model {
        public $id;
        public $status;

        public function __construct() {
            $this->db_name = 'mexflix';
        }

        public function create($body = array()){
            foreach($body as $key => $value) {
                // Variables variables
                // Example
                // $var = 'Hello';
                // $$var = 'World';
                // echo $var . ' '. $Hello ===> 'Hello World';
                $$key = $value;
            }

            $this->query = "INSERT INTO status (id, status) VALUES ($id, '$status')";

            $this->set_query();
        }

        public function read($status_id = ''){
            $this->query = $status_id != '' ? "SELECT * FROM status WHERE id = $status_id" : "SELECT * FROM status";
        
            $this->get_query();
            // var_dump($this->rows);

            $num_rows = count($this->rows);

            $data = array();

            foreach($this->rows as $key => $value) {
                array_push($data, $value);
                // $data[$key] = $value;
            }

            return $data;

            // return $this->rows;
        }

        public function update($body = array()){
            foreach($body as $key => $value) {
                $$key = $value;
            }

            $this->query = "UPDATE status SET status = '$status' WHERE id = $id";
            $this->set_query();
        }

        public function delete($id = ''){
            $this->query = "DELETE FROM status WHERE id = $id";
            $this->set_query();
        }

        public function __destruct() {
            // unset($this);
        }
    }

    