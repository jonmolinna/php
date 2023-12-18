<?php

    class UsersModels extends Model {
        public function set($body = array()){
            foreach ($body as $key => $value) {
                $$key = $value;
            }

            $this->query = "REPLACE INTO users (user, email, name, birthday, password, role) VALUES ('$user', '$email', '$name', '$birthday', MD5('$password'), '$role')";
            $this->set_query();
        }

        public function get($user = '') {
            $this->query = $user != '' ? "SELECT * FROM users WHERE user = '$user'" : "SELECT * FROM users";

            $this->get_query();

            $num_rows = count($this->rows);

            $data = array();

             foreach($this->rows as $key => $value) {
                array_push($data, $value);
             }

             return $data;
        }

        public function delete($id = '') {
            $this->query = "DELETE FROM users WHERE user = '$id'";
            $this->set_query();
        }

        public function validate_user($user, $password) {
            $this->query = "SELECT * FROM users WHERE user = '$user' AND password = MD5('$password') ";
            $this->get_query();

            $data = array();

            foreach($this->rows as $key => $value) {
                array_push($data, $value);
            }

            return $data;
        }

        public function __destruct() {
            // unset($this);
        }
    }