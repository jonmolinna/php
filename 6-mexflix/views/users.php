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
        $template_users = '
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
                                <input type="hidden" name="r" value="users-add">
                                <input
                                    class="bg-cyan-700 p-2 rounded-md cursor-pointer" 
                                    type="submit" 
                                    value="Agregar"
                                >
                            </form>
                        </th>
                    </tr>';
        
        for ($i=0; $i < count($data); $i++) {
            $template_users .= '
                <tr>
                    <td class="text-center text-black font-medium">
                        ' . $data[$i]['user'] . '
                    </td>
                    <td class="text-center text-black font-medium">
                        ' . $data[$i]['email'] . '
                    </td>
                    <td class="text-center text-black font-medium">
                        ' . $data[$i]['name'] . '
                    </td>
                    <td class="text-center text-black font-medium">
                        ' . $data[$i]['birthday'] . '
                    </td>
                    <td class="text-center text-black font-medium">
                        ' . $data[$i]['password'] . '
                    </td>
                    <td class="text-center text-black font-medium">
                        ' . $data[$i]['role'] . '
                    </td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="r" value="user-edit">
                            <input type="hidden" name="user" value="' . $data[$i]['user'] . '">
                            <input 
                                class="bg-green-800 p-1 px-2 text-white rounded-md cursor-pointer"
                                type="submit" 
                                value="Editar"
                            >
                        </form>
                    </td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="r" value="user-delete">
                            <input type="hidden" name="user" value="' . $data[$i]['user'] . '">
                            <input 
                                class="bg-red-800 p-1 px-2 text-white rounded-md cursor-pointer"
                                type="submit" 
                                value="Eliminar"
                            >
                        </form>
                    </td>
                </tr>
            ';
        }

        $template_users .= '
                </table>
            </div>
        ';

        print($template_users);
    }
