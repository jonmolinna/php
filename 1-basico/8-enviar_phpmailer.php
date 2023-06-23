<?php

    // Capturando datos del formulario
    $de = $_POST["de_txt"];
    $para = $_POST["para_txt"];
    $asunto = $_POST["asunto_txt"];
    $mensaje = $_POST["mensaje_txa"];

    // Permite quitar codigos extraños en el correo
    $cabeceras = "MIME-Version: 1.0\r\n";
    $cabeceras .= "Content-type: text/html; charset-iso-8859-1\r\n";
    $cabeceras .= "From: $de \r\n";

    $archivo = $_FILES["archivo_fls"]["tmp_name"];
    $destino = $_FILES["archivo_fls"]["name"];

    if (move_uploaded_file($archivo, $destino)) {
        include_once("correo/class.phpmailer.php");
        include_once("correo/class.smtp.php");

        // Creando un objeto de phpmailer
        $mail = new PHPMailer();
        $mail->IsSMTP(); // protocolo SMTP
        $mail->SMTPAuth = true; // autenticacion en el SMTP
        $mail->SMTPSecure = "ssl"; // SSL, security socket layer
        $mail->Host = "smtp.gmail.com"; // servidor SMTP de gmail
        $mail->Port = 465; // puerto seguro del servidor SMTP de gmail
        $mail->From = $de; // Remitente del correo
        $mail->AddAddress($para); // Destinatario
        $mail->Username = "tu_correo";
        $mail->Password = "tu_password";
        $ail->Subject = $asunto;
        $mail->Body = $mensaje;
        $mail->WordWrap = 50; // Numero de columnas
        $mail->MsgHTML($mensaje); // Indica que el cuerpo del correo tendra formato html
        $mail->AddAttachment($destino); // Accedemos el archivo que se subio al servidor y lo adjuntamos

        if ($mail->Send()) { // enviamos el correo por PHPMailer
            $respuesta = "El mensaje ha sido enviado con tu cuenta gmail";
        } else {
            $respuesta = "El mensaje no se pudo enviar";
            $respuesta .= "Error: ".$email->ErrorInfo;
        }


    } else {
        $respuesta = "Ocurrio un error al subir el archivo adjunto =(";
    }

    unlink($destino); // Borramos el archivo del servidor
    header("Location: 8-formulario_phpmailer.php?respuesta=$respuesta");

?>