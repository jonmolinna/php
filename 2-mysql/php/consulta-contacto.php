<form id="consulta-contacto" name="consulta_form" method="get" action="">
    <fieldset>
        <legend>Consulta de contactos</legend>
        <label for="consulta-lista">Tipo de consulta</label>
        <select name="consulta_slc" id="consulta-lista" required>
            <option value="">- - -</option>
            <option value="todos" <?php if($_GET["consulta_slc"] ?? null == "todos"){echo " selected";}; ?>>Todos</option>
            <option value="email" <?php if($_GET["consulta_slc"] ?? null == "email"){echo " selected";}; ?>>Por email</option>
            <option value="inicial" <?php if($_GET["consulta_slc"] ?? null == "inicial"){echo " selected";}; ?>>Por inicial</option>
            <option value="sexo" <?php if($_GET["consulta_slc"] ?? null == "sexo"){echo " selected";}; ?>>Por sexo</option>
            <option value="pais" <?php if($_GET["consulta_slc"] ?? null == "pais"){echo " selected";}; ?>>Por país</option>
            <option value="buscador" <?php if($_GET["consulta_slc"] ?? null == "buscador"){echo " selected";}; ?>>Tipo buscador</option>
        </select>
        <?php
            switch($_GET["consulta_slc"] ?? null) {
                case "todos":
                    include("php/consulta-todo.php");
                    break;
                case "email":
                    include("php/consulta-email.php");
                    break;
                case "inicial":
                    include("php/consulta-inicial.php");
                    break;
                case "sexo":
                    include("php/consulta-sexo.php");
                    break;
                case "pais":
                    include("php/consulta-pais.php");
                    break;
                case "buscador":
                    include("php/consulta-buscador.php");
                    break;
            }
        ?>
    </fieldset>
</form>

<script>
    window.onload = function() {
        const lista = document.getElementById("consulta-lista");

        lista.onchange = function() {
            window.location = "index.php?op=consultas&consulta_slc="+lista.value;
        }
    }
</script>