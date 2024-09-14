<?php

    require_once "../../config/app.php";
    require_once "../views/inc/session_start.php";
    require_once "../../autoload.php";

    use app\controllers\UserController;

    if (isset($_POST['modulo_user'])) {
        $user = new UserController();

        if ($_POST['modulo_user'] == "register") {
            echo $user->registerUserController();
        }

        if ($_POST['modulo_user'] == 'delete') {
            echo $user->deleteUserController();
        }

        if ($_POST['modulo_user'] == 'updated') {
            echo $user->updatedUserController();
        }

    } else {
        session_destroy();
        header("Location: " . APP_URL . "login/");
    }


?>