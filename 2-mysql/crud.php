<?php

$connection = mysqli_connect("localhost", "root", "molina125") or die("No se pudo conectar con el servidor de BD");
echo "Conectado al Servido de BD MySQL <br />";

mysqli_select_db($connection, "contactos_php") or die("No se pudo seleccionar la BD <br />");
echo "BD Seleccionada <br />";

echo "<h3>Las 4 operaciones Basicas CRUD</h3>";
echo "<p>1. Create </p>";
// INSERT INTO name_table (campos_table) VALUES (valores_table)
$insert = "INSERT INTO contactos (email, nombre, sexo, nacimiento, telefono, pais, imagen) VALUES ('emma.saenz@gmail.com','Emma Saenz','F','1998-07-24','51934585249','Peru','emma.png')";
$mysql = mysqli_query($connection, $insert);
echo "Se han insertado los datos <br />";

echo "<p>2. Delete</p>";
// DELETE FROM name_table WHERE campo = valor
$delete = "DELETE FROM contactos WHERE email = 'emma.saenz@gmail.com'";
$mysql = mysqli_query($connection, $delete);
echo "Datos eliminados <br />";

echo "<p>3. Modificar</p>";
// UPDATE name_table SET name_campo = valor_campo, otro_campo = otro_valor WHERE campo = valor
$update = "UPDATE contactos SET nombre = 'Meryem Contreras' WHERE email = 'kendra.contreras98@gmail.com'";
$mysql = mysqli_query($connection, $update);
echo "Los datos han sido modificados <br />";

echo "<p>4. Consulta de Datos </p>";
// SELECT * FROM name_tabla WHERE campo = valor
$query = "SELECT * FROM contactos WHERE email = 'kendra.contreras98@gmail.com'";
$mysql = mysqli_query($connection, $query);
while ($registro=mysqli_fetch_array($mysql)) {
    echo $registro["email"]."---";
    echo $registro["nombre"]."---";
    echo $registro["sexo"]."---";
    echo $registro["nacimiento"]."---";
    echo $registro["telefono"]."---";
    echo $registro["pais"]."---";
    echo $registro["imagen"]."---";
    echo "<br />";
    echo "<br />";
};

mysqli_close($connection);
echo "Conexion Cerrada";

?>