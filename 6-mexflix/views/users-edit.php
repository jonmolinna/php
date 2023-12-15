<?php

    $users_controller = new UsersController();

    if ($_POST['r'] == 'users-edit' && $_SESSION['role'] == 'ADMIN' && !isset($_POST['crud'])) {
        $data = $users_controller->get($_POST['user']);

        if (empty($data)) {
            $template = '
                <div class="">
                    <p>No existe el usuario: %s</p>
                </div>
                <script>
                    window.onload = function() {
                        reloadPage("usuarios");
                    }
                </script>
            ';

            printf($template, $_POST['user']);
        }
        else {
            $role_admin = ($data[0]['role'] == 'ADMIN') ? 'checked' : '';
            $role_user = ($data[0]['role'] == 'USER') ? 'checked' : '';

            $template_user = '
                <div class="flex flex-col items-center space-y-3">
                    <h2>Editar Status</h2>
                    <form class="space-y-2 w-[300px]" method="POST">
                        <div>
                            <input
                                type="text"
                                placeholder="Usuario"
                                value="%s" 
                                disabled 
                                required
                                class="p-1 rounded-md w-full"
                            >
                            <input type="hidden" name="user" value="%s">
                        </div>
                        <div>
                            <input 
                                type="email" 
                                name="email" 
                                placeholder="email" 
                                value="%s" 
                                required
                                class="text-black p-1 rounded-md w-full"
                            >
                        </div>
                        <div>
                            <input 
                                type="text" 
                                name="name" 
                                placeholder="Nombre" 
                                value="%s" 
                                required
                                class="text-black p-1 rounded-md w-full"
                            >
                        </div>
                        <div>
                            <input 
                                type="text" 
                                name="birthday" 
                                placeholder="Cumpleaños" 
                                value="%s" 
                                required
                                class="text-black p-1 rounded-md w-full"
                            >
                        </div>
                        <div>
                            <input 
                                type="password" 
                                name="password" 
                                placeholder="Contraseña" 
                                value=""
                                required
                                class="text-black p-1 rounded-md w-full"
                            >
                        </div>
                        <div>
                            <input 
                                type="radio" 
                                name="role" 
                                id="admin"
                                value="ADMIN"
                                %s
                                required
                            >
                            <label for="admin">Administrador</label>
                            <input 
                                type="radio" 
                                name="role" 
                                id="noadmin"
                                value="USER"
                                %s
                                required
                            >
                            <label for="noadmin">Usuario</label>
                        </div>
                        <div>
                            <input 
                                type="submit"
                                value="Editar"
                                class="p-1 rounded-md bg-green-700 w-full cursor-pointer hover:bg-green-500" 
                            >
                            <input type="hidden" name="r" value="users-edit" >
                            <input type="hidden" name="crud" value="set" >
                        </div>
                    </form>
                </div>
            ';

            printf(
                $template_user,
                $data[0]['user'],
                $data[0]['user'],
                $data[0]['email'],
                $data[0]['name'],
                $data[0]['birthday'],
                // $data[0]['password'],
                $role_admin,
                $role_user
            );
        }
    }
    else if ($_POST['r'] == 'users-edit' && $_SESSION['role'] == 'ADMIN' && $_POST['crud'] == 'set') {
        $body = array(
            'user' => $_POST['user'],
            'email' => $_POST['email'],
            'name' => $_POST['name'],
            'birthday' => $_POST['birthday'],
            'password' => $_POST['password'],
            'role' => $_POST['role'],
        );

        $user = $users_controller->set($body);

        $template = '
            <div class="container mx-auto rounded-md">
                <p class="text-center bg-green-700 text-white py-2">
                    Usuario: %s guardado
                </p>
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