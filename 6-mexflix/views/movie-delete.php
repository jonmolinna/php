<?php

    $movies_controller = new MoviesController();

    if ($_POST['r'] == 'movie-delete' && $_SESSION['role'] == 'ADMIN' && !isset($_POST['crud'])) {
        $movie = $movies_controller->get($_POST['id']);

        if (empty($movie)) {
            $template = '
                <div class="">
                    <p>No existe el video: %s</p>
                </div>
                <script>
                    window.onload = function() {
                        reloadPage("movies");
                    }
                </script>
            ';

            printf($template, $_POST['id']);
        }
        else {
            $template = '
                <div class="flex flex-col items-center space-y-3">
                    <h2 class="font-medium text-xl">Eliminar Movie</h2>
                    <form method="POST">
                        <div class="text-lg">
                            ¿Estas seguro de eliminar el Video: %s ?
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
                            <input type="hidden" name="id" value="%s" >
                            <input type="hidden" name="r" value="movie-delete" >
                            <input type="hidden" name="crud" value="delete" >
                        </div>
                    </form>
                </div>
            ';

            printf(
                $template,
                $movie[0]['id'],
                $movie[0]['id'],
            );
        }
    }
    else if ($_POST['r'] == 'movie-delete' && $_SESSION['role'] == 'ADMIN' && $_POST['crud'] == 'delete') {
        $movie = $movies_controller->delete($_POST['id']);

        $template = '
            <div class="container mx-auto rounded-md">
                <p class="text-center bg-red-700 text-white py-2">Movie: %s Eliminado</p>
            </div>

            <script>
                window.onload  = function() {
                    reloadPage("movies");
                }
            </script>
        ';

        printf($template, $_POST['id']);
    }
    else {
        $controller = new ViewController();
        $controller->load_view('error401');
    }
