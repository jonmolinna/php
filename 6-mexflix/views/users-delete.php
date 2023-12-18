<?php

    $users_controller = new UsersController();

    if ($_POST['r'] == 'users-delete' && $_SESSION['role'] == 'ADMIN' && !isset($_POST['crud'])) {
        $data = $users_controller->get($_POST['user']);
        
        if (empty($data)) {
            $template = '
                <div class="">
                    <p>No existe el estatus: %s</p>
                </div>
                <script>
                    window.onload = function() {
                        reloadPage("status");
                    }
                </script>
            ';

            printf($template, $_POST['user']);
        }
        else {
            $template_user = '
                <div class="flex flex-col items-center space-y-3">
                    <h2 class="font-medium text-xl">Eliminar Usuario</h2>
                    <form method="POST">
                        <div class="text-lg">
                            ¿Estas seguro de eliminar el Usuario: %s ?
                        </div>
                        <div class="flex items-center justify-center mt-3 space-x-4">
                            <input 
                                type="submit"
                                value="Si"
                                class="bg-green-700 py-1 px-3 rounded-md hover:bg-green-500 cursor-pointer"
                            >
                            <input 
                                type="button"
                                value="No" onclick="history.back()"
                                class="bg-red-700 py-1 px-3 rounded-md hover:bg-red-500 cursor-pointer"
                            >
                            <input type="hidden" name="user" value="%s" >
                            <input type="hidden" name="r" value="users-delete" >
                            <input type="hidden" name="crud" value="delete" >
                        </div>
                    </form>
                </div>
            ';

            printf(
                $template_user,
                $data[0]['user'],
                $data[0]['user'],
            );
        }

    }
    else if ($_POST['r'] == 'users-delete' && $_SESSION['role'] == 'ADMIN' && $_POST['crud'] == 'delete') {
        $data = $users_controller->delete($_POST['user']);

        $template = '
            <div class="container mx-auto rounded-md">
                <p class="text-center bg-red-700 text-white py-2">Usuario: %s Eliminado</p>
            </div>

            <script>
                window.onload  = function() {
                    reloadPage("usuarios");
                }
            </script>
        ';

        printf($template, $_POST['user']);
    }
    else {
        $controller = new ViewController();
        $controller->load_view('error401');
    }
