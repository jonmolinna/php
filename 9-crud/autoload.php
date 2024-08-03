<?php

    spl_autoload_register(function($clase) {
        $file = __DIR__ . "/" . $clase . ".php";
        $file = str_replace("\\", "/", $file);

        if (is_file($file)) {
            require_once $file;
        }

    })

?>