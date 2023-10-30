<?php

    require_once('Model.php');

    class StatusModel extends Model {
        public $id;
        public $status;

        public function __construct() {
            $this->db_name = 'mexflix';
        }

        public function create(){}

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

        public function update(){}

        public function delete(){}

        public function __destruct() {
            // unset($this);
        }
    }

    