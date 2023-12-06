<?php

    print('
        <h2 class="text-center font-bold text-lg">Gestión de Status</h2>
    ');

    $status_controller = new StatusController();
    $data = $status_controller->get();

    // empty => verifica que el array esta vacio
    // print_r($data);

    if (empty($data)) {
        print('
            <div>
                <p>No hay Status</p>
            </div>
        ');
    } else {
        $template_status = '
            <div>
                <table>
                    <tr>
                        <th>Id</th>
                        <th>Status</th>
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

        for ($i=0; $i < count($data); $i++) {
            $template_status .= '
                <tr>
                    <td class="text-center text-black font-medium">
                        ' . $data[$i]['id'] . '
                    </td>
                    <td class="text-center text-black font-medium">
                        ' . $data[$i]['status'] . '
                    </td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="r" value="status-edit">
                            <input type="hidden" name="status_id" value="' . $data[$i]['id'] . '">
                            <input 
                                class="bg-green-800 p-1 px-2 text-white rounded-md cursor-pointer"
                                type="submit" 
                                value="Editar"
                            >
                        </form>
                    </td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="r" value="status-delete">
                            <input type="hidden" name="status_id" value="' . $data[$i]['id'] . '">
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

        $template_status .= '
                </table>
            </div>
        ';

        print($template_status);
    }