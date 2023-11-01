<?php

    require('StatusModel.php');

    echo '<h1>CRUD con MVC de la tabla Status</h1>';

    $status = new StatusModel();

    $data = $status->read();
    // var_dump($data);

    $num_status = count($data);

    echo "<h2>Numeros de Status: $num_status </h2>";

    echo "<h2>Tabla de Status</h2>";
    echo '
        <table>
            <tr>
                <th>id</th>
                <th>status</th>
            </tr>';
            for ($n = 0; $n < count($data); $n++) {
                echo '
                    <tr>
                        <td>' . $data[$n]['id'] . '</td>
                        <td>' . $data[$n]['status']. '</td>
                    </tr>
                ';
            }
    echo '</table>';

    echo '<h2>Insertando Status</h2>';
    // Array associativa
    $new_status = array(
        'id' => 0,
        'status' => 'Novelas',
    );

    // $status->create($new_status);

    echo '<h2>Actualizando Status</h2>';
    $update_status = array(
        'id' => 7,
        'status' => 'Other Status'
    );

    // $status->update($update_status);

    echo '<h2>Eliminando Status</h2>';
    // $status->delete(7);

