<?php

    class Telefono {
        public $marca;
        public $modelo;
        protected $alambrico = true;
        protected $cominicacion;

        public function __construct($marca, $modelo) {
            $this->marca = $marca;
            $this->modelo = $modelo;
            $this->comunicacion = $this->alambrico ? 'Alámbrica' : 'Inalámbrica';
        }

        public function llamar() {
            return print '<p>Ring Ring Ring</p>';
        }

        public function mas_info() {
            return print '
                <ul>
                    <li> Marca: ' .$this->marca . '</li>
                    <li> Modelo: ' .$this->modelo . '</li>
                    <li> Comunicación; ' .$this->comunicacion . '</li>
                </ul>
            ';
        }
    }

    class Celular extends Telefono {
        protected $alambrico = false;

        public function __construct($marca, $modelo) {
            parent::__construct($marca, $modelo);
        }
    }

    final class SmarthPhone extends Celular {
        public $alambrico = false;
        public $internet = true;

        public function __construct($marca, $modelo) {
            parent::__construct($marca, $modelo);
        }

        public function mas_info() {
            return print '
                <ul>
                    <li> Marca: ' .$this->marca . '</li>
                    <li> Modelo: ' .$this->modelo . '</li>
                    <li> Comunicación; ' .$this->comunicacion . '</li>
                    <li>Dispositivo con acceso a Internet</li>
                </ul>
            ';
        }
    }

    echo '<h1>Evolucion del telefono</h1>';
    echo '<h2>Telefono:</h2>';
    $telef = new Telefono('Panasonic', 'KX-TS550');
    $telef->llamar();
    $telef->mas_info();

    echo '<h2>Celular:</h2>';
    $celu = new Celular('Nokia', '5120');
    $celu->llamar();
    $celu->mas_info();

    echo '<h2>SmarthPhone:</h2>';
    $smar = new SmarthPhone('Huawei', 'Y5');
    $smar->llamar();
    $smar->mas_info();


?>