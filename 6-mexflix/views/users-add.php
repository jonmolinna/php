<?php

    if ($_POST['r'] == 'users-add' && $_SESSION['role'] == 'ADMIN' && !isset($_POST['crud'])) {
        print('
            <div class="flex justify-center">
                <div>
                    <h2 class="text-xl text-center mb-4">
                        Agregar Status
                    </h2>
                    <form 
                        method="POST"
                        class="space-y-3"
                    >
                        <div>
                            <input 
                                type="text" 
                                name="user" 
                                placeholder="Usuario" 
                                required
                                class="py-2 px-1 text-black"
                            >
                        </div>
                        <div>
                            <input 
                                type="email" 
                                name="email" 
                                placeholder="Email" 
                                required
                                class="py-2 px-1 text-black"
                            >
                        </div>
                        <div>
                            <input 
                                type="text" 
                                name="name" 
                                placeholder="Nombres" 
                                required
                                class="py-2 px-1 text-black"
                            >
                        </div>
                        <div>
                            <input 
                                type="text" 
                                name="birthday" 
                                placeholder="Cumpleaños" 
                                required
                                class="py-2 px-1 text-black"
                            >
                        </div>
                        <div>
                            <input 
                                type="password" 
                                name="password" 
                                placeholder="Contraseña" 
                                required
                                class="py-2 px-1 text-black"
                            >
                        </div>
                        <div>
                            <input 
                                type="radio" 
                                name="role" 
                                id="admin"
                                value="ADMIN"
                                required
                            >
                            <label for="admin">Administrador</label>
                            <input 
                                type="radio" 
                                name="role" 
                                id="noadmin"
                                value="USER"
                                required
                            >
                            <label for="noadmin">Usuario</label>
                        </div>
                        <div>
                            <input 
                                type="submit" 
                                value="Agregar"
                                class="bg-green-700 py-2 px-1 w-full rounded-md cursor-pointer hover:bg-green-500"
                            >
                            <input type="hidden" name="r" value="users-add" >
                            <input type="hidden" name="crud" value="set" >
                        </div>
                    </form>
                </div>
            </div>        
        ');
    } 
    else if ($_POST['r'] == 'users-add' && $_SESSION['role'] == 'ADMIN' && $_POST['crud'] == 'set') {
        $users_controller = new UsersController();

        $new_user = array(
            'user' => $_POST['user'],
            'email' => $_POST['email'],
            'name' => $_POST['name'],
            'birthday' => $_POST['birthday'],
            'password' => $_POST['password'],
            'role' => $_POST['role']
        );

        $data = $users_controller->set($new_user);

        $template = '
            <div class="container mx-auto rounded-md">
                <p class="text-center bg-green-700 text-white py-2">
                    Status: %s guardado
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