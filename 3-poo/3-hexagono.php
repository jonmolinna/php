<?php

    class Hexagono extends Poligono {
        private $lado;
        private $apotema;

        public function __construct($lado, $apotema) {
            $this->lados = 6;
            $this->lado = $lado;
            $this->apotema = $apotema;
        }

        public function perimetro() {
            return $this->lados * $this->lado;
        }

        public function area() {
            return ($this->perimetro()  * $this->apotema) / 2;
        }
    }