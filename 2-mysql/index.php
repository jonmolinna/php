<?php
    error_reporting(E_ALL & ~E_NOTICE);
    $op = $_GET['op'] ?? '';
    switch($op) {
        case "alta":
            $contenido = "php/alta-contacto.php";
            $titulo = "Alta de Contacto";
            break;
        case "baja":
            $contenido = "php/baja-contacto.php";
            $titulo = "Baja de Contacto";
            break;
        case "cambios":
            $contenido = "php/cambios-contacto.php";
            $titulo = "Cambio a Contacto";
            break;
        case "consultas":
            $contenido = "php/consulta-contacto.php";
            $titulo = "Consultas a Contacto";
            break;
        default:
            $contenido = "php/home.php";
            $titulo = "Mis contactos v1";
            break;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo; ?></title>
    <link rel="stylesheet" href="./css/mis-contactos.css" />
</head>
<body>
    
    <section id="contenido">
        <nav>
            <ul>
                <li><a href="index.php" class="cambio">Home</a></li>
                <li><a href="?op=alta" class="cambio">Alta de Contacto</a></li>
                <li><a href="?op=baja" class="cambio">Baja de Contacto</a></li>
                <li><a href="?op=cambios" class="cambio">Cambios de Contacto</a></li>
                <li><a href="?op=consultas" class="cambio">Consultas de Contacto</a></li>
            </ul>
        </nav>
        <section id="principal">
            <?php include($contenido); ?>
        </section>
    </section>
    
    
    <script src="js/mis-contactos.js" type="module"></script>
    
</body>
</html>