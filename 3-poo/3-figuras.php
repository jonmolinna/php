<?php

    require('./3-poligonos.php');
    require('./3-triangulo.php');
    require('./3-cuadrado.php');
    require('./3-rectangulo.php');
    require('./3-hexagono.php');

    echo '
        <h1>Poligonos</h1>
        <p>Figura geometrica plana que esta limitada por tres o mas rectas y tiene
        tres o mas angulos y vertices.</p>

        <h2>Perimetros</h2>
        <p>El perimetro de un poligono es igual a la suma de las longitudes de sus lados.</p>

        <h2>Area</h2>
        <p>El area de un poligono es la medida de la region o superficie encerrada por un poligono</p>

        <hr>
    ';

    echo '<h3>Triangulo</h3>';
    $triangle = new Triangulo(3, 6, 9, 10);
    echo '<p>' . $triangle->lados() . '<p>';
    echo '<p>Perimetro del ' .get_class($triangle) . ': ' .$triangle->perimetro() . '</p>';
    echo '<p>Area del ' .get_class($triangle) . ': ' .$triangle->area() . '</p>';
    echo '<hr>';
    
    echo '<h3>Cuadrado</h3>';
    $square = new Cuadrado(7);
    echo '<p>' .$square->lados() . '</p>';
    echo '<p>Perimetro del ' .get_class($square) . ': ' .$square->perimetro() . '</p>';
    echo '<p>Area del ' .get_class($square) . ': ' .$square->area() . '</p>';
    echo '<hr>';
    
    echo '<h3>Rectangulo</h3>';
    $rectangle = new Rectangulo(7, 9);
    echo '<p>' .$rectangle->lados() . '</p>';
    echo '<p>Perimetro del ' .get_class($rectangle) . ': ' .$rectangle->perimetro() . '</p>';
    echo '<p>Area del ' .get_class($rectangle) . ': ' .$rectangle->area() . '</p>';
    echo '<hr>';
    
    echo '<h3>Hexagono</h3>';
    $hexagono = new Hexagono(8, 9);
    echo '<p>' .$hexagono->lados() . '</p>';
    echo '<p>Perimetro del ' .get_class($hexagono) . ': ' .$hexagono->perimetro() . '</p>';
    echo '<p>Area del ' .get_class($hexagono) . ': ' .$hexagono->area() . '</p>';
    echo '<hr>';
