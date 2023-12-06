<?php

    if ($_POST['r'] == 'status-add' && $_SESSION['role'] == 'ADMIN' && !isset($_POST['crud'])) {
        print('
            <div class="flex justify-center">
                <div>
                    <h2 class="text-xl text-center mb-4">
                        Agregar Status
                    </h2>
                    <form 
                        method="POST"
                        class="space-y-3"
                    >
                        <div>
                            <input 
                                type="text" 
                                name="status" 
                                placeholder="status" 
                                required
                                class="py-2 px-1 text-black"
                            >
                        </div>
                        <div>
                            <input 
                                type="submit" 
                                value="Agregar"
                                class="bg-green-700 py-2 px-1 w-full rounded-md cursor-pointer hover:bg-green-500"
                            >
                            <input type="hidden" name="r" value="status-add" >
                            <input type="hidden" name="crud" value="set" >
                        </div>
                    </form>
                </div>
            </div>
        ');
    } 
    else if ($_POST['r'] == 'status-add' && $_SESSION['role'] == 'ADMIN' && $_POST['crud'] == 'set') {
        // Programa la insercion
        $status_controller = new StatusController();
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