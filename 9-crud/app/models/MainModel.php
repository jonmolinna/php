<?php

    namespace app\models;
    use \PDO;

    if (file_exists(__DIR__ . "/../../config/server.php")) {
        require_once __DIR__ . "/../../config/server.php";
    }

    class MainModel {
        private $server = DB_SERVER;
        private $database = DB_NAME;
        private $user = DB_USER;
        private $password = DB_PASSWORD;

        protected function connection() {
            $conexion = new PDO("mysql:host=". $this->server .";dbname=". $this->database, $this->user, $this->password);
            $conexion->exec("SET CHARACTER SET utf8");
            return $conexion;
        }

        protected function get_query($query) {
            $sql = $this->connection()->prepare($query);
            $sql->execute();
            return $sql;
        }

        // evitar Inyeccion SQL
        public function creanString($cadena) {
            $words = ["<script>","</script>","<script src","<script type=","SELECT * FROM","SELECT "," SELECT ","DELETE FROM","INSERT INTO","DROP TABLE","DROP DATABASE","TRUNCATE TABLE","SHOW TABLES","SHOW DATABASES","<?php","?>","--","^","<",">","==","=",";","::"];

            // Quitar espacios en blanco al inicio o al final
            $cadena = trim($cadena);

            // Quitar la \
            $cadena = stripslashes($cadena);

            // Quitar las palabras del words
            foreach($words as $word) {
                $cadena = str_ireplace($word, "",$cadena);
            }

            $cadena = trim($cadena);
            $cadena = stripslashes($cadena);

            return $cadena;
        }

        protected function compareData($filtro, $cadena) {
            // Comparando una exmpresion regular
            if (preg_match("/^" .$filtro. "$/", $cadena)) {
                return false;
            } else {
                return true;
            }
        }

        protected function addData($table, $datos) {
            $query = "INSERT INTO $table (";

            $contador = 0;

            foreach($datos as $key){
                if ($contador >= 1) {
                    $query .=",";
                }

                $query .= $key["campo_nombre"];
                $contador++;
            }

            $query .= ") VALUES(";

            $contador = 0;
            
            foreach($datos as $key) {
                if ($contador >= 1) {
                    $query .= ",";
                }

                $query .= $key["campo_marcador"];
                $contador++;
            }

            $query .= ")";

            $sql = $this->connection()->prepare($query);

            // Cambiamos el marcador por el valor real
            foreach($datos as $key) {
                $sql->bindParam($key["campo_marcador"], $key["campo_valor"]);
            }

            // Ejecutar la consulta
            $sql->execute();

            return $sql;
        }

        protected function getData($type, $table, $campo, $id) {
            $type = $this->creanString($type);
            $table = $this->creanString($table);
            $campo = $this->creanString($campo);
            $id = $this->creanString($id);

            if ($type == "unique") {
                $sql = $this->connection()->prepare("SELECT * FROM $table WHERE $campo = :ID");
                $sql->bindParam(":ID", $did);
            }
            elseif ($type == "normal") {
                $sql = $this->connection()->prepare("SELECT $campo FROM $table");
            }

            $sql->execute();
            return $sql;
        }

        protected function updatedData($table, $data, $condition) {
            $query = "UPDATE $table SET (";
            $contador = 0;

            foreach($data as $key) {
                if ($contador >= 1) {
                    $query .= ",";
                }

                $query .= $key["campo_nombre"] ."=". $key["campo_marcador"];
                $contador++;
            }

            $query .= " WHERE " . $condition["condicion_campo"] ."=". $condition["condicion_marcador"];
            
            $sql = $this->connection()->prepare($query);

            // Sustituir los marcadores por los valores reales
            foreach($data as $key) {
                $sql->bindParam($key["campo_marcador"], $key["campo_valor"]);
            }

            $sql->bindParam($condition["condicion_marcador"], $condition["condicion_valor"]);

            $sql->execute();
            return $sql;
        }

        protected function deleteData($table, $campo, $id) {
            $sql = $this->connection()->prepare("DELETE FROM $table WHERE $campo = :id");

            $sql->bindParam(":id", $id);
            $sql->execute();

            return $sql;
        }

        protected function paginadorTablas($page, $numPages, $url, $buttons) {
            $table = '<nav class="pagination is-centered is-rounded" role="navigation" aria-label="pagination">';

            if ($page <= 1) {
                $table .= '
                    <a class="pagination-previous is-disabled" disabled>Anterior</a>
                    <ul class="pagination-list">
                ';
            } else {
                $table .= '
                    <a class="pagination-previous" href="' .$url.($page-1). '/">Anterior</a>
                    <ul class="pagination-list">
                        <li><a class="pagination-link" href="' .$url. '1/">1</a></li>
                        <li><span class="pagination-ellipsis">&hellip;</span></li>
                ';
            }

            $count = 0;

            for ($i = $page; $i <= $numPages; $i++) {
                if ($count >= $buttons) {
                    break;
                }

                if ($page == $i) {
                    $table .= '<li><a class="pagination-link is-current" href="' .$url.$i. '/">' .$i. '</a></li>';
                } else {
                    $table .= '<li><a class="pagination-link" href="' .$url.$i. '/">' .$i. '</a></li>';
                }

                $count++;
            }

            if ($page == $numPages) {
                $table .= '
                    </ul>
                    <a class="pagination-next is-disabled" disabled>Siguiente</a>
                ';
            } else {
                $table .= '
                    <li><span class="pagination-ellipsis">&hellip;</span></li>
                    <li><a class="pagination-link" href="' .$url.$numPages. '/">' .$numPages. '</a></li>
                </ul>
                <a class="pagination-next" href="' .$url.($page+1). '/">Siguiente</a>
                ';
            }

            $table .= '</nav>';

            return $table;
        }
    }

?>