<?php

    class Perro {
        // Atributo
        public $name;
        public $race;
        public $age;
        public $gender;
        public $adiestrado;
        public $picture;
        public $food;
        private $pulgas;
        public static $mejor_amigo = 'Hombre';
        const MEJOR_CUALIDAD = 'Fidelidad';

        // Metodos Magico
        public function __construct($nombre, $raza, $edad, $sexo, $adiestrado, $foto, $pulga) {
            $this->name = $nombre;
            $this->race = $raza;
            $this->age = $edad . ' años';
            $this->gender = $sexo ? 'Macho' : 'Hembra';
            $this->adiestrado = $adiestrado? 'Adiestrado' : 'No Adiestrado';
            $this->picture = $foto;
            $this->pulgas = $pulga;
        }

        // Metodos
        public function ladrar() {
            echo '<p>Los perros ladran</p>';
        }

        public function comer($comida) {
            $this->food = $comida;
            echo '<p>' . $this->name . ' Come ' . $this->food . '</p>';
        }

        public function aparecer() {
            echo '<img src="' .$this->picture .'">';
        }

        public function tiene_pulgas() {
            echo $this->pulgas ? '<´p>Tiene Pulga</p>' : '<p>No tiene pulga</p>';
        }

        public function mas_info() {
            // $this->ladrar();
            self::ladrar();
            Perro::comer('Tallarin');
            echo '<p>El mejor amigo del perro es el ' . Perro::$mejor_amigo . '</p>';
            echo '<p>' . Perro::MEJOR_CUALIDAD . '</P>';
        }

        // Metodos Magico
        public function __destruct() {}
    }

    // Instanciar una clase
    $kenai = new Perro(
        'Kenai', 
        'Firefox',
        3, 
        true,
        true, 
        'https://images.pexels.com/photos/1458925/pexels-photo-1458925.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1',
        false,
    );

    // var_dump($kenai);
    echo '<p>' . $kenai->name . '</>';
    echo '<p>' . $kenai->race . '</p>';
    echo '<p>' . $kenai->age . '</p>';
    echo '<p>' . $kenai->gender . '</p>';
    echo '<p>' . $kenai->adiestrado . '</p>';
    // echo '<p>' . $kenai->pulgas . '</p>'; No se puede acceder

    $kenai->ladrar();
    $kenai->comer('Croqueta');
    $kenai->aparecer();
    $kenai->tiene_pulgas();
    $kenai->mas_info();