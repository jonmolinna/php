<?php

    class Cuadrado extends Poligono {
        private $lado;

        public function __construct($lado) {
            $this->lados = 4;
            $this->lado = $lado;
        }

        public function perimetro() {
            return $this->lados * $this->lado;;
        }

        public function area() {
            return pow($this->lado, 2);
        }
    }