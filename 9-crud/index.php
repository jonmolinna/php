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
        use app\controllers\LoginController;

        $isLogin = new LoginController();

        $view_controller = new ViewsController();
        $view = $view_controller->getViewsController($url[0]);

        if ($view == 'login' || $view == '404') {
            require_once "./app/views/content/" . $view . "-view.php";
        } else {
            // Cerrar Session
            if (!isset($_SESSION['id']) || !isset($_SESSION['username']) || $_SESSION['id'] == "" || $_SESSION['username'] == "") {
                $isLogin->closeSession();
                // Detenemos la ejecucion
                exit();
            }
            require_once "./app/views/inc/navbar.php";
            require_once $view;
        }

        require_once "./app/views/inc/script.php"; 
        
    ?>
    
</body>
</html>

<!-- https://www.youtube.com/watch?v=RX5pESvne1A&list=PLH_tVOsiVGzl-l_yDiedZyOKZSUayupki&index=52 -->