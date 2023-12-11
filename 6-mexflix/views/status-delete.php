<?php
    $status_controller = new StatusController();

    if ($_POST['r'] == 'status-delete' && $_SESSION['role'] == 'ADMIN' && !isset($_POST['crud'])) {
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
                    <h2 class="font-medium text-xl">Eliminar Status</h2>
                    <form method="POST">
                        <div class="text-lg">
                            ¿Estas seguro de eliminar el Status: %s ?
                        </div>
                        <div class="flex items-center justify-center mt-3 space-x-4">
                            <input 
                                type="submit"
                                value="Si"
                                class="bg-green-700 py-1 px-3 rounded-md hover:bg-green-500 cursor-pointer"
                            >
                            <input 
                                type="button"
                                value="No" onclick="history.back()"
                                class="bg-red-700 py-1 px-3 rounded-md hover:bg-red-500 cursor-pointer"
                            >
                            <input type="hidden" name="status_id" value="%s" >
                            <input type="hidden" name="r" value="status-delete" >
                            <input type="hidden" name="crud" value="delete" >
                        </div>
                    </form>
                </div>
            ';

            printf(
                $template_status,
                $data[0]['status'],
                $data[0]['id'],
            );
        }
    } 
    else if ($_POST['r'] == 'status-delete' && $_SESSION['role'] == 'ADMIN' && $_POST['crud'] == 'delete') {
        // Programa delete
        $status = $status_controller->delete($_POST['status_id']);

        $template = '
            <div class="container mx-auto rounded-md">
                <p class="text-center bg-red-700 text-white py-2">Status: %s Eliminado</p>
            </div>

            <script>
                window.onload  = function() {
                    reloadPage("status");
                }
            </script>
        ';

        printf($template, $_POST['status_id']);
    } else {
        // Vista de no autorizacion
        $controller = new ViewController();
        $controller->load_view('error401');
    }