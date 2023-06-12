<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>Formulario enviado por el metodo GET</h1>
    <form name="envia-get_frm" action="3-envia_datos.php" method="get" enctype="application/x-www-form-urlencoded">
        <label for="">Ingresa tu Nombre: </label>
        <input type="text" name="name_txt" />
        <br><br>
        <label for="">Ingresa tu Password: </label>
        <input type="password" name="password_txt" />
        <br><br>
        <input type="submit" name="enviar_btn" value="Envia-Get">
    </form>

    <h1>Formulario enviado por el metodo POST</h1>
    <form name="envia-get_frm" action="3-envia_datos.php" method="post" enctype="application/x-www-form-urlencoded">
        <label for="">Ingresa tu Nombre: </label>
        <input type="text" name="name_txt" />
        <br><br>
        <label for="">Ingresa tu Password: </label>
        <input type="password" name="password_txt" />
        <br><br>
        <input type="submit" name="enviar_btn" value="Envia-Post">
    </form>
    
</body>
</html>