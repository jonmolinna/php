<?php

    class StatusModel extends Model {

        public function set($body = array()){
            foreach($body as $key => $value) {
                $$key = $value;
            }

            $this->query = "REPLACE INTO status (id, status) VALUES ($id, '$status')";
            $this->set_query();
        }

        public function get($status_id = ''){
            $this->query = $status_id != '' ? "SELECT * FROM status WHERE id = $status_id" : "SELECT * FROM status";
        
            $this->get_query();
            $num_rows = count($this->rows);
            $data = array();

            foreach($this->rows as $key => $value) {
                array_push($data, $value);
            }

            return $data;
        }

        public function delete($id = ''){
            $this->query = "DELETE FROM status WHERE id = $id";
            $this->set_query();
        }

        public function __destruct() {
            // unset($this);
        }
    }

    