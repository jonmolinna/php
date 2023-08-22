<?php
// Asigno a variables php los valores que vienen del formulario
// como el campo del email esta deshabilitado en el form php no lo reconoce
// por eso tengo que guardar su valor en un campo oculto

$email = $_POST["email_hdn"];
$name = $_POST["nombre_txt"];
$gender = $_POST["sexo_rdo"];
$nacimiento = $_POST["nacimiento_txt"];
$phone = $_POST["telefono_txt"];
$country = $_POST["pais_slc"];

include("conexion.php");

$query = "SELECT * FROM contactos WHERE email = '$email'";
$data = $connection->query($query);
$numero_registro = $data->num_rows;

if ($numero_registro == 1) {
    // Si la foto viene vacia asignamos el valor del boton oculto de la foto
    // que tiene el valor anterior a la busqueda, sino subo la nueva y reemplazo el valor
    if (empty($_FILES["foto_fls"]["tmp_name"])) {
        $imagen = $_POST["foto_hdn"];
    } else {
        // Se ejecuta la funcion para subir la imagen
        include("funciones.php");
        $type = $_FILES["foto_fls"]["type"];
        $file = $_FILES["foto_fls"]["tmp_name"];
        $imagen = subir_imagen($type, $file, $email);
    }

    // actualizo los datos al BD
    $consulta = "UPDATE contactos SET nombre='$name', sexo='$gender', nacimiento='$nacimiento', telefono='$phone', pais='$country', imagen='$imagen' WHERE email='$email'";

    $ejecutar_consulta = $connection->query(utf8_encode($consulta));

    if ($ejecutar_consulta) {
        $mensaje = "Se actualizo correctamente";
    } else {
        $mensaje = "No se actualizo los datos";
    }

} else {
    $mensaje = "No se actualizaron los datos";
}

$connection->close();
header("Location: ../index.php?op=cambios&mensaje=$mensaje");


?>