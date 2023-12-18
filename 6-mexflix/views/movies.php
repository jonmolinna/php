<?php

    print('
        <h2 class="text-center font-bold text-lg">Gestión de Status</h2>
    ');

    $movie_controller = new MoviesController();
    $data = $movie_controller->get();

    if (empty($data)) {
        print('
            <div class="text-center mt-3">
                <p>No hay Movies</p>
            </div>
        ');
    }
    else {
        $template_users = '
            <div>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Titulo</th>
                        <th>Estreno</th>
                        <th>Generos</th>
                        <th>Status</th>
                        <th>Categoria</th>
                        <th colspan="3">
                            <form method="POST">
                                <input type="hidden" name="r" value="users-add">
                                <input
                                    class="bg-cyan-700 p-2 rounded-md cursor-pointer" 
                                    type="submit" 
                                    value="Agregar"
                                >
                            </form>
                        </th>
                    </tr>';
    }