<?php

$connection = mysqli_connect("localhost", "root", "molina125") or die("No se pudo conectar con el servidor de BD");
echo "Conectado al Servido de BD MySQL <br />";

mysqli_select_db($connection, "contactos_php") or die("No se pudo seleccionar la BD <br />");
echo "BD Seleccionada <br />";

echo "<h3>Las 4 operaciones Basicas CRUD</h3>";
echo "<p>1. Create </p>";
// INSERT INTO name_table (campos_table) VALUES (valores_table)
$insert = "INSERT INTO contactos (email, nombre, sexo, nacimiento, telefono, pais, imagen) VALUES ('kendra.contreras98@gmail.com','Kendra Contreras','F','1998-07-24','51934585249','Peru','kendra.png')";
$insert_result = mysqli_query($connection, $insert);
echo "Se han insertado los datos <br />";

// 55:46


?>