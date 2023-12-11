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
                <div class="flex flex-col items-center space-y-3">
                    <h2>Editar Status</h2>
                    <form class="space-y-2" method="POST">
                        <div>
                            <input
                                type="text"
                                placeholder="status_id"
                                value="%s" 
                                disabled 
                                required
                                class="p-1 rounded-md"
                            >
                            <input type="hidden" name="status_id" value="%s">
                        </div>
                        <div>
                            <input 
                                type="text" 
                                name="status" 
                                placeholder="status" 
                                value="%s" required
                                class="text-black p-1 rounded-md"
                            >
                        </div>
                        <div>
                            <input 
                                type="submit"
                                value="Editar"
                                class="p-1 rounded-md bg-green-700 w-full cursor-pointer hover:bg-green-500" 
                            >
                            <input type="hidden" name="r" value="status-edit" >
                            <input type="hidden" name="crud" value="set" >
                        </div>
                    </form>
                </div>
            ';

            printf(
                $template_status,
                $data[0]['id'],
                $data[0]['id'],
                $data[0]['status'],
            );
        }
    } 
    else if ($_POST['r'] == 'status-edit' && $_SESSION['role'] == 'ADMIN' && $_POST['crud'] == 'set') {
        // Programa la insercion
        $form_status = array('id' => $_POST['status_id'], 'status' => $_POST['status']);

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