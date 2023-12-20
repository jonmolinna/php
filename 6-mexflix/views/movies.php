<?php

    print('
        <h2 class="text-center font-bold text-lg">Gestión de Videos</h2>
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
        $template_movie = '
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
                                <input type="hidden" name="r" value="movie-add">
                                <input
                                    class="bg-cyan-700 p-2 rounded-md cursor-pointer" 
                                    type="submit" 
                                    value="Agregar"
                                >
                            </form>
                        </th>
                    </tr>';
        for ($i=0; $i < count($data); $i++) {
            $template_movie .= '
                <tr>
                    <td class="text-center text-black font-medium">
                        ' . $data[$i]['id'] . '
                    </td>
                    <td class="text-center text-black font-medium">
                        ' . $data[$i]['title'] . '
                    </td>
                    <td class="text-center text-black font-medium">
                        ' . $data[$i]['premiere'] . '
                    </td>
                    <td class="text-center text-black font-medium">
                        ' . $data[$i]['genres'] . '
                    </td>
                    <td class="text-center text-black font-medium">
                        ' . $data[$i]['status'] . '
                    </td>
                    <td class="text-center text-black font-medium">
                        ' . $data[$i]['category'] . '
                    </td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="r" value="movie-show">
                            <input type="hidden" name="id" value="' . $data[$i]['id'] . '">
                            <input 
                                class="bg-pink-800 p-1 px-2 text-white rounded-md cursor-pointer"
                                type="submit" 
                                value="Mostrar"
                            >
                        </form>
                    </td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="r" value="movie-edit">
                            <input type="hidden" name="id" value="' . $data[$i]['id'] . '">
                            <input 
                                class="bg-green-800 p-1 px-2 text-white rounded-md cursor-pointer"
                                type="submit" 
                                value="Editar"
                            >
                        </form>
                    </td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="r" value="movie-delete">
                            <input type="hidden" name="id" value="' . $data[$i]['id'] . '">
                            <input 
                                class="bg-red-800 p-1 px-2 text-white rounded-md cursor-pointer"
                                type="submit" 
                                value="Eliminar"
                            >
                        </form>
                    </td>
                </tr>
            ';
        }

        $template_movie .= '
                </table>
            </div>
        ';

        print($template_movie);
    }