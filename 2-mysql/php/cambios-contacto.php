<script>
    window.addEventListener("load", function() {
        const lista = document.getElementById("contacto-lista");
        lista.onchange = seleccionarContacto;

        function seleccionarContacto() {
            window.location="?op=cambios&contacto_slc="+lista.value;
        }
    });
</script>


<form id="cambio-contacto" name="cambio_frm" action="php/modificar-contacto.php" method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>Cambio de contacto</legend>
        <div>
            <label for="contacto-lista">Contacto:</label>
            <select id="contacto-lista" class="cambio" name="contacto_slc" required>
                <option value="">- - -</option>
                <?php include("select-email.php") ?>
            </select>
        </div>
        <?php
            if($_GET["contacto_slc"] ?? null) {
                $connection2 = conectarse();
                $contact = $_GET["contacto_slc"];
                $query = "SELECT * FROM contactos WHERE email = '$contact'";
                $data = $connection2->query($query);
                $registro_contacto = $data->fetch_assoc();

                include("php/cambio-form.php");
            }

            include("php/mensajes.php");
        ?>
    </fieldset>
</form>