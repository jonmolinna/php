<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script>

        // Metodo GET
        function validarDatosGET() {
            let verificar = true;
            const form = document.valida_datos_get_frm;

            if (!form.name_txt.value) {
                alert("El campo name es requerido");
                form.name_txt.focus();
                verificar = false;
            } else if (!form.password_txt.value) {
                alert("El campo password es requerido");
                form.password_txt.focus();
                verificar = false;
            } else if (!form.sexo_rdo[0].checked && !form.sexo_rdo[1].checked) {
                alert("El campo sexo es requirido");
                form.sexo_rdo[0].focus();
                verificar = false;
            }

            if (verificar) {
                form.submit();
            }
        };

        // Metodo POST
        function validarDatosPOST() {
            let verificar = true;
            const form = document.valida_datos_post_frm;

            if (!form.name_txt.value) {
                alert("El campo name es requerido");
                form.name_txt.focus();
                verificar = false;
            } else if (!form.password_txt.value) {
                alert("El campo password es requerido");
                form.password_txt.focus();
                verificar = false;
            } else if (!form.sexo_rdo[0].checked && !form.sexo_rdo[1].checked) {
                alert("El campo sexo es requirido");
                form.sexo_rdo[0].focus();
                verificar = false;
            }

            if (verificar) {
                form.submit();
            }
        };

        window.onload = function() {
            document.getElementById("enviar_get").onclick = validarDatosGET;
            document.getElementById("enviar_post").onclick = validarDatosPOST;
        }


    </script>

</head>
<body>

    <?php
        error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

        if ($_GET["error"] === "si") {
            echo "<span style=\"color: #F00; font-size:1.3rem\">Verifica tus datos</span>";
        }
    ?>

    <h1>Formulario de Datos GET</h1>
    <form 
        name="valida_datos_get_frm"
        action="4-validar_datos.php"
        method="get"
        enctype="application/x-www-form-urlencoded"
    >
        Ingresa tu nombre:
        <input type="text" name="name_txt" />
        <br><br>
        Ingresa tu password:
        <input type="password" name="password_txt">
        <br><br>
        <input type="radio" name="sexo_rdo" value="M"> Masculino
        &nbsp;
        <input type="radio" name="sexo_rdo" value="F"> Femenino
        &nbsp;
        <br><br>
        <input type="hidden" name="enviar_hdn" value="get">
        <input type="button" id="enviar_get" name="enviar_btn" value="Enviar_GET">
    </form>


    <h1>Formulario de Datos POST</h1>
    <form 
        name="valida_datos_post_frm"
        action="4-validar_datos.php"
        method="post"
        enctype="application/x-www-form-urlencoded"
    >
        Ingresa tu nombre:
        <input type="text" name="name_txt" />
        <br><br>
        Ingresa tu password:
        <input type="password" name="password_txt">
        <br><br>
        <input type="radio" name="sexo_rdo" value="M"> Masculino
        &nbsp;
        <input type="radio" name="sexo_rdo" value="F"> Femenino
        &nbsp;
        <br><br>
        <input type="hidden" name="enviar_hdn" value="post">
        <input type="button" id="enviar_post" name="enviar_btn" value="Enviar_POST">
    </form>
    
</body>
</html>