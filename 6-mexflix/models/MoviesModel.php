<?php

    class MoviesModel extends Model {
        public function set($body = array()) {
            foreach($body as $key => $value) {
                $$key = $value;
            }

            $this->query = "REPLACE INTO movies SET id = '$id', title = '$title',
            plot = '$plot', author = '$author', actors = '$actors', country='$country',
            premiere = '$premiere', poster = '$poster', trailer = '$trailer', rating = $rating,
            genres = '$genres', status = '$status', category = '$category'
            ";

            $this->set_query();
        }

        public function get($id = '') {
            $this->query = $id != '' ?
            "SELECT movie.id, movie.title, movie.plot, movie.author, movie.actors, movie.country, movie.premiere, movie.poster, movie.trailer, movie.rating, movie.genres, movie.category, statu.status FROM movies AS movie INNER JOIN status AS statu ON movie.status = statu.id WHERE movie.id = '$id'"
             : 
             "SELECT movie.id, movie.title, movie.plot, movie.author, movie.actors, movie.country, movie.premiere, movie.poster, movie.trailer, movie.rating, movie.genres, movie.category, statu.status FROM movies AS movie INNER JOIN status AS statu ON movie.status = statu.id";

            $this->get_query();
            $num_rows = count($this->rows);
            $data = array();

            foreach ($this->rows as $key => $value) {
                array_push($data, $value);
            }

            return $data;
        }

        public function delete($id = '') {
            $this->query = "DELETE FROM movies WHERE id = '$id'";
            $this->set_query();
        }

        public function __destruct() {
            // unset($this);
        }


    }