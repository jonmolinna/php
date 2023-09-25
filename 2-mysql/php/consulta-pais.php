<br>
<div>
    <input type="hidden" name="op" value="consultas">
    <label for="pais">Pais:</label>
    <select id="pais" class="cambio" name="pais_slc" required>
        <option value="">- - -</option>
        <?php include("select-pais.php") ?>
    </select>
</div>

<input type="submit" id="enviar-buscar" class="cambio" name="enviar_btn" value="buscar">

<?php
    if ($_GET["pais_slc"] ?? null) {
        if($_GET["pais_slc"] != null) {
            // $country = utf8_encode($_GET["pais_slc"]);
            $country = iconv('ISO-8859-1', 'UTF-8', $_GET["pais_slc"]);
            $query = "SELECT * FROM contactos WHERE pais = '$country'";
            include("tabla-resultados.php");
        }
    }

?>