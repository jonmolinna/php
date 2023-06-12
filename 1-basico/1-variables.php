<?php

// Imprimir en la pantalla
echo "Hola Mundo";
echo "<br />";

// Variables
$name = 'Jon Dallas';
$lastName = 'Contreras';

// Concatenación de cadenas y variables
echo $name." ".$lastName;
echo "<br />";

$num1 = 5;
$num2 = 78;

$suma = $num1 + $num2;
echo $suma;
echo "<br />";

$modulo = $num2 % 2;

if ($modulo == 0) {
    echo "El n&uacute;mero es Par";
} else {
    echo "El n&uacute;mero es Impar";
}

echo "<br />";


// Ciclo For
for ($i = 0; $i <= 10; $i++) {
    echo $i."<br />";
}


?>