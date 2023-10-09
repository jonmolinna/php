<?php

    class Rectangulo extends Poligono {
        private $base;
        private $altura;

        public function __construct($base, $altura) {
            $this->lados = 4;
            $this->base = $base;
            $this->altura = $altura;
        }

        public function perimetro() {
            return ($this->base + $this->altura) * 2;
        }

        public function area() {
            return $this->base * $this->altura;
        }
    }