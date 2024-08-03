<?php

    require_once "./config/app.php";
    require_once "./autoload.php";
    require_once "./app/views/inc/session_start.php";

    if (isset($_GET['views'])) {
        $url = explode("/", $_GET['views']);
    } else {
        $url = ['login'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <?php require_once "./app/views/inc/head.php"; ?>

</head>
<body>



    <?php 
        use app\controllers\ViewsController;

        $view_controller = new ViewsController();
        $view = $view_controller->getViewsController($url[0]);

        if ($view == 'login' || $view == '404') {
            require_once "./app/views/content/" . $view . "-view.php";
        } else {
            require_once "./app/views/inc/navbar.php";
            require_once $view;
        }

        require_once "./app/views/inc/script.php"; 
        
    ?>
    
</body>
</html>