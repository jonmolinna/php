<?php

    include("conexion.php");
    include("funciones.php");

    $data = $connection->query($query);
    $num_regs = $data->num_rows;

    if ($num_regs == 0) {
        echo "<br/><br/> <span class='mensajes'>No se encontraron registros</span>";
    } else {
?>

    <br><br>

    <table>
        <thead>
            <tr>
                <th>Email</th>
                <th>Nombre</th>
                <th>Sexo</th>
                <th>Nacimiento</th>
                <th>Telefono</th>
                <th>Pais</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($data as $person) {
            ?>
                <tr>
                    <td><?php echo $person["email"]; ?></td>
                    <td><?php echo $person["nombre"]; ?></td>
                    <td><?php echo ($person["sexo"]=='M')? "Masculino": "Femenino"; ?></td>
                    <td><?php echo $person["nacimiento"]; ?></td>
                    <td><?php echo $person["telefono"]; ?></td>
                    <td><?php echo mb_convert_encoding($person["pais"], 'ISO-8859-1', 'UTF-8'); ?></td>
                    <td>
                        <img 
                            src="img/fotos/<?php echo $person["imagen"]; ?>" 
                            alt=""
                        >
                    </td>
                </tr>
            <?php
                }
            ?>
        </tbody>
    </table>

<?php
    }

$connection->close()

?>
