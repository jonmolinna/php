<?php
    abstract class Model {
        // Atributos
        private static $db_host = 'localhost';
        private static $db_user = 'root';
        private static $db_password = 'molina125';
        protected $db_name;
        private static $db_charset = 'utf8';
        private $connection;
        protected $query;
        protected $rows = array();

        // Metodos
        // Metodos Abstractos
        abstract protected function create();
        abstract protected function read();
        abstract protected function update();
        abstract protected function delete();

        // Metodos Privados
        private function db_open() {
            $this->connection = new mysqli(
                self::$db_host,
                self::$db_user,
                self::$db_password,
                $this->db_name,
            );

            $this->connection->set_charset(self::$db_charset);
        }

        private function db_close() {
            $this->connection->close();
        }

        // INSERT, DELETE, UPDATE
        protected function set_query() {
            $this->db_open();
            $this->connection->query($this->query);
            $this->db_close();
        }

        // SELECT
        protected function get_query() {
            $this->db_open();

            $result = $this->connection->query($this->query);

            while($this->rows[] = $result->fetch_assoc());
            // foreach($this->rows[] = $result as $data )

            $result->close();

            $this->db_close();

            return array_pop($this->rows);
        }
    }