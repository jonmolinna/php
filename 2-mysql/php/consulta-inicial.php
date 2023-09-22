<br><br>

<?php
    $str = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','Ñ','O','P','Q','R','S','T','U','V','W','X','Y','Z');

    // Con un for se muestra en pantalla todo el abcdario
    // Se contruye un enlace dinamico por cada letra del abcdario
    for($i=0; $i < count($str); $i++) {
        if ($str[$i] == "Z") {
            echo "<a class='cambio' href='?op=consultas&consulta_slc=inicial&letra=".$str[$i]."'>".$str[$i]."</a>";
        } else {
            echo "<a class='cambio' href='?op=consultas&consulta_slc=inicial&letra=".$str[$i]."'>".$str[$i]."</a>\n-\n";
        }
    }

    if ($_GET["letra"] ?? null) {
        if($_GET["letra"] != null) {
            $first = $_GET["letra"];
            $query = "SELECT * FROM contactos WHERE nombre LIKE '$first%';";
    
            include("tabla-resultados.php");
        }
    }


?>