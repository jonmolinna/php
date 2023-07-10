<?php

    // El parametro de $extension determina que tipo de imagen no se borrara por ejemplo si es
    // jpg significa que la imagen con extension .jpg se queda en el servidor y si existen imagenes
    // con el mismo nombre pero con extension png o gif se eliminaran con esta funcion evito tener
    // imagenes duplicadas con distinta extensiones para cada perfil la funcion file_exists evalua
    // si un archivo existe y la funcion unlink borra un archivo del servidor.

    function borrar_imagenes($ruta, $extension) {
        switch($extension) {
            case ".jpg":
                if(file_exists($ruta.".png")) {
                    unlink($ruta.".png");
                }
                if(file_exists($ruta.".gif")) {
                    unlink($ruta.".gif");
                }
                break;

            case ".gif":
                if(file_exists($ruta.".png")) {
                    unlink($ruta.".png");
                }
                if(file_exists($ruta.".jpg")) {
                    unlink($ruta.".jpg");
                }
                break;

            case ".png":
                if(file_exists($ruta.".jpg")) {
                    unlink($ruta.".jpg");
                }
                if(file_exists($ruta.".gif")) {
                    unlink($ruta.".gif");
                }
                break;
        }
    };

    function subir_imagen($type, $file, $email) {
        // strstr($cadena1, $cadena2) sirve para evaluar si en la primer cadena de texto existe la segunda cadena de texto
        // si dentro del tipo del archivo se encuentra la palabra image significa que el archivo es un imagen

        if(strstr($type, "image")) {
            // Si el archivo es una imagen
            if(strstr($type, "jpeg")) {
                $extension = ".jpg";
            }
            else if(strstr($type, "gif")) {
                $extension = ".gif";
            }
            else if(strstr($type, "png")) {
                $extension = ".png";
            }

            // Para saber si la imagen tiene el ancho correcto que es de 420px
            $img_size = getimagesize($file);
            $width_img = $img_size[0];
            $height_img = $img_size[1];
            $ancho_img_deseado = 420;

            // Si la imagen es mayor en su ancho que 420px, reajusto su tamaño
            if($width_img > $ancho_img_deseado) {
                // Por una regla de 3 obtengo el alto de la imagen de manera proporcional al ancho nuevo que sera 420
                $new_width_img = $ancho_img_deseado;
                $new_height_img = ($height_img/$width_img)*$new_width_img;

                // Creo una imagen en color real con las nuevas dimensiones
                $img_reajustada = imagecreatetruecolor($new_width_img, $new_height_img);

                // Creo una imagen basada en la original, dependiendo de su extension es el tipo que creare.
                switch($extension) {
                    case ".jpg":
                        $img_original = imagecreatefromjpeg($file);
                        // Reajusto la imagen nueva con respecto a la original
                        imagecopyresampled($img_reajustada, $img_original, 0, 0, 0, 0, $new_width_img, $new_height_img, $width_img, $height_img);

                        // Guardo la imagen reescalada en el servidor
                        $name_img_ext = "../img/fotos/".$email.$extension;
                        $name_img = "../img/fotos/".$email;
                        imagejpeg($img_reajustada, $name_img_ext, 100);

                        // Ejecuto la funcion para borrar posibles imagenes dobles para el perfil
                        borrar_imagenes($name_img, ".jpg");
                        break;
                    
                    case ".gif":
                        $img_original = imagecreatefromgif($file);
                        // Reajusto la imagen nueva con respecto a la original
                        imagecopyresampled($img_reajustada, $img_original, 0, 0, 0, 0, $new_width_img, $new_height_img, $width_img, $height_img);

                        // Guardo la imagen reescalada en el servidor
                        $name_img_ext = "../img/fotos/".$email.$extension;
                        $name_img = "../img/fotos/".$email;
                        imagegif($img_reajustada, $name_img_ext, 100);

                        // Ejecuto la funcion para borrar posibles imagenes dobles para el perfil
                        borrar_imagenes($name_img, ".gif");
                        break;

                    case ".png":
                        $img_original = imagecreatefrompng($file);
                        // Reajusto la imagen nueva con respecto a la original
                        imagecopyresampled($img_reajustada, $img_original, 0, 0, 0, 0, $new_width_img, $new_height_img, $width_img, $height_img);

                        // Guardo la imagen reescalada en el servidor
                        $name_img_ext = "../img/fotos/".$email.$extension;
                        $name_img = "../img/fotos/".$email;
                        imagepng($img_reajustada, $name_img_ext, 100);

                        // Ejecuto la funcion para borrar posibles imagenes dobles para el perfil
                        borrar_imagenes($name_img, ".png");
                        break;
                }
            } else {
                // Guardo la ruta que tendra en el servidor la imagen
                $destino = "../img/fotos/".$email.$extension;

                // Se sube la foto
                move_uploaded_file($file, $destino) or die('No se pudo subir la imagen al servidor');

                // Ejecuto la funcion para borrar posibles imagenes dobles para el perfil
                $name_img = "../img/fotos/".$email;
                borrar_imagenes($name_img, $extension);
            }

            // Asigno el nombre de la foto que se guardara en la BD como cadena de texto
            $imagen = $email.$extension;
            return $imagen;

        } else {
            return false;
        }
    };


?>
