<?php

    print('
        <h2 class="text-center font-bold text-lg">Gestión de Usuarios</h2>
    ');

    $users_controller = new UsersController();
    $data = $users_controller->get();
    // $data = array();

    if (empty($data)) {
        print('
            <div class="text-center mt-3">
                <p>No hay Usuarios</p>
            </div>
        ');
    } else {
        $template_status = '
            <div>
                <table>
                    <tr>
                        <th>Usuario</th>
                        <th>Email</th>
                        <th>Nombre</th>
                        <th>Cumpleaños</th>
                        <th>Contraseña</th>
                        <th>Rol</th>
                        <th colspan="2">
                            <form method="POST">
                                <input type="hidden" name="r" value="status-add">
                                <input
                                    class="bg-cyan-700 p-2 rounded-md cursor-pointer" 
                                    type="submit" 
                                    value="Agregar"
                                >
                            </form>
                        </th>
                    </tr>';
    }
