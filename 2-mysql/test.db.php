<?php

    // Pasos para conectarme a una BD Mysql con php
    // 1. conectarme al BD, mysql_connect necesita 3 datos:
    //      a. Servirdor
    //      b. usuario de la BD
    //      c. Password del usuario de la BD

    $connection = mysqli_connect("localhost", "root", "molina125") or die ("No se pudo conectar con el servidor de BD");
    echo "Estoy conectado a MYSQL <br />";

    // 2. Seleccionar la BD con la que vamos a trabajar
    mysqli_select_db($connection, "contactos_php") or die("Nose pudo seleccionar la BD");
    echo "BD seleccionado";

    // 3. Crea una consulta SQL
    $query = "SELECT * FROM pais";

    // 4. Ejecuta la consulta SQL
    $result = mysqli_query($connection, $query) or die ("No se pudo ejecutar la consulta en la BD");
    echo "<br /> Se ejecuto la consulta SQL <br />";

    // 5. Mostrar el resultado de ejecutar la consulta
    while($registro = mysqli_fetch_array($result)) {
        echo $registro["id_pais"]." - ".$registro["pais"]."<br />";
    }

    // 6. Cerrar la conexion a la BD
    mysqli_close($connection) or die("Ocurrio un error al cerrar la conexion la BD");
    echo "<br /> Conexion Cerrada";

?>