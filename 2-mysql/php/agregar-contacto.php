<?php

    // Asigno a variables de php los valores que vienen del formulario
    $email = $_POST["email_txt"];
    $name = $_POST["nombre_txt"];
    $gender = $_POST["sexo_rdo"];
    $age = $_POST["nacimiento_txt"];
    $phono = $_POST["telefono_txt"];
    $country = $_POST["pais_slc"];

    $img_gender = ($gender == 'M') ? "img/fotos/amigo.png" : "img/fotos/amiga.png";

    # Verificamos que no exista el email del usuario
    include "conexion.php";

    $query = "SELECT * FROM contactos WHERE email = '$email'";
    $data = $connection->query($query);
    $number_registro = $data->num_rows; # trae numero de registro

    if ($number_registro == 0) {
        // insert DB
        include "funciones.php";
        $type = $_FILES["foto_fls"]["type"];
        $file = $_FILES["foto_fls"]["tmp_name"];
        $se_subio_imagen = subir_imagen($type, $file, $email);

        # si la foto del formulario viene vacio, entonces se asigna el valor de la imagen generica.
        $imagen = empty($file) ? $img_gender : $se_subio_imagen;

        $insert = "INSERT INTO contactos (email, nombre, sexo, nacimiento, telefono, pais, imagen) VALUES ('$email','$name','$gender','$age','$phono','$country', '$imagen')"; // return true or false

        $data = $connection->query(utf8_encode($insert));
        if($data) {
            $mensaje = "Se inserto un registro";
        } else {
            $mensaje = "No se pudo registrar el contacto";
        }

    } else {
        $mensaje = "Ya existe el email";
    }

    $connection->close();
    header("Location: ../index.php?op=alta&mensaje=$mensaje");


?>