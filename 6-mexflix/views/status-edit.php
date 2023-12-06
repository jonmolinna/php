<?php
    $status_controller = new StatusController();

    if ($_POST['r'] == 'status-edit' && $_SESSION['role'] == 'ADMIN' && !isset($_POST['crud'])) {
        $data = $status_controller->get($_POST['status_id']);

        if (empty($data)) {
            $template = '
                <div class="">
                    <p>No existe el estatus: %s</p>
                </div>
                <script>
                    window.onload = function() {
                        reloadPage("status");
                    }
                </script>
            ';

            printf($template, $_POST['status_id']);
        } else {
            $template_status = '
                <h2>Editar Status</h2>
                <form>
                    <div>
                        <input type="text" placeholder="status_id" value="%s" disabled required >
                        <input type="hidden" name="status_id" value="%s">
                    </div>
                    <div>
                        <input 
                            type="text" 
                            name="status" 
                            placeholder="status" 
                            value="%s" required
                            class="text-black"
                        >
                    </div>
                    <div>
                        <input type="submit" value="Editar" >
                        <input type="hidden" name="r" value="status-edit" >
                        <input type="hidden" name="crud" value="set" >
                    </div>
                </form>
            ';

            printf(
                $template_status,
                $data[0]['id'],
                $data[0]['id'],
                $data[0]['status'],
            );
        }
    } 
    else if ($_POST['r'] == 'status-add' && $_SESSION['role'] == 'ADMIN' && $_POST['crud'] == 'set') {
        // Programa la insercion
        $form_status = array('id' => 0, 'status' => $_POST['status']);

        $status = $status_controller->set($form_status);

        $template = '
            <div class="container mx-auto rounded-md">
                <p class="text-center bg-green-700 text-white py-2">Status: %s guardado</p>
            </div>

            <script>
                window.onload  = function() {
                    reloadPage("status");
                }
            </script>
        ';

        printf($template, $_POST['status']);
    } else {
        // Vista de no autorizacion
        $controller = new ViewController();
        $controller->load_view('error401');
    }