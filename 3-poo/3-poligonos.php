<?php

    abstract class Poligono {
        protected $lados;

        abstract protected function perimetro();

        abstract protected function area();

        public function lados() {
            return 'Un ' . get_called_class() . ' Tiene ' . $this->lados . ' Lados';
        }
    }