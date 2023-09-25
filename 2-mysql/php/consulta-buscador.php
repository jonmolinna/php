<br>
<div>
    <input type="hidden" name="op" value="consultas">
    <label for="buscador">Buscador:</label>
    <input type="search" id="buscador" class="cambio" name="q" placeholder="Escribe tu busqueda" title="Tu busqueda">
</div>
<input type="submit" id="enviar-buscar" class="cambio" name="enviar_btn" value="buscar">

<?php
    if ($_GET['q'] ?? null) {
        if ($_GET["q"] != null) {
            // $q = $_GET["q"];
            $q = iconv('ISO-8859-1', 'UTF-8', $_GET["q"]);
            $query = "SELECT * FROM contactos WHERE MATCH(email, nombre, sexo, telefono, pais) AGAINST('$q' IN BOOLEAN MODE)";
            include("tabla-resultados.php");
        }
    }
?>