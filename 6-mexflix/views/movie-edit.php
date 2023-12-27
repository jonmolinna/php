<?php

    $movies_controller = new MoviesController();

    if ($_POST['r'] == 'movie-edit' && $_SESSION['role'] == 'ADMIN' && !isset($_POST['crud'])) {
        $movie = $movies_controller->get($_POST['id']);
        // $movie = array();

        if (empty($movie)) {
            $template = '
                <div class="">
                    <p>No existe el Video: %s</p>
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
            $category_movie = $movie[0]['category'] == 'Movie' ? 'checked' : '';
            $category_serie = $movie[0]['category'] == 'Serie' ? 'checked' : '';

            $status_controller = new StatusController();
            $status = $status_controller->get();
            $status_select = '';

            for ($i=0; $i < count($status); $i++) {
                $selected = $movie[0]['status'] == $status[$i]['status'] ? 'selected' : '';
                $status_select .= '<option value="' .$status[$i]['id'] . '"' .$selected . '>' . $status[$i]['status'] . '</option>';
            }

            $template_movie = '
            <div class="flex justify-center">
                <div>
                    <h2 class="text-xl text-center mb-4">
                        Editar Movie
                    </h2>
                    <form method="POST" class="mb-10 grid grid-cols-4 gap-4">
                        <div>
                            <input 
                                type="text" 
                                name="id" 
                                placeholder="Id"
                                value="%s"
                                required
                                disabled
                                class="py-2 px-1 text-black"
                            >
                            <input type="hidden" name="id" value="%s">
                        </div>
                        <div>
                            <input 
                                type="text" 
                                name="title" 
                                placeholder="Title"
                                value="%s"
                                required
                                class="py-2 px-1 text-black"
                            >
                        </div>
                        <div class="order-1 col-span-4">
                            <textarea 
                                type="text" 
                                name="plot" 
                                placeholder="Description" 
                                cols="22" rows="3"
                                class="py-2 px-1 text-black w-full"
                            >%s</textarea> 
                        </div>
                        <div>
                            <input 
                                type="text" 
                                name="author" 
                                placeholder="Autor"
                                value="%s"
                                required
                                class="py-2 px-1 text-black"
                            >
                        </div>
                        <div>
                            <input 
                                type="text" 
                                name="actors" 
                                placeholder="Actores"
                                value="%s"
                                required
                                class="py-2 px-1 text-black"
                            >
                        </div>
                        <div>
                            <input 
                                type="text" 
                                name="country" 
                                placeholder="Pais" 
                                value="%s"
                                required
                                class="py-2 px-1 text-black"
                            >
                        </div>
                        <div>
                            <input 
                                type="text" 
                                name="premiere" 
                                placeholder="Estreno"
                                value="%s"
                                required
                                class="py-2 px-1 text-black"
                            >
                        </div>
                        <div>
                            <input 
                                type="url" 
                                name="poster" 
                                placeholder="Poster"
                                value="%s" 
                                required
                                class="py-2 px-1 text-black"
                            >
                        </div>
                        <div>
                            <input 
                                type="url" 
                                name="trailer" 
                                placeholder="Trailer"
                                value="%s"
                                required
                                class="py-2 px-1 text-black"
                            >
                        </div>
                        <div>
                            <input 
                                type="number" 
                                name="rating" 
                                placeholder="Rating"
                                value="%s" 
                                required
                                class="py-2 px-1 text-black"
                            >
                        </div>
                        <div>
                            <input 
                                type="text" 
                                name="genres" 
                                placeholder="Géneros"
                                value="%s"x
                                required
                                class="py-2 px-1 text-black"
                            >
                        </div>
                        <div>
                            <select 
                                class="py-2 px-1 text-black w-full" 
                                name="status"
                                required
                            >
                                <option value="">--- ---</option>
                                %s
                            </select>
                        </div>
                        <div class="flex justify-evenly">
                            <div>
                                <input type="radio" name="category" id="movie" value="Movie" %s required />
                                <label for="movie">Movie</label>
                            </div>
                            <div>
                                <input type="radio" name="category" id="serie" value="Serie" %s required />
                                <label for="serie">Serie</label>
                            </div>
                        </div>
                        <div class="order-2">
                            <input 
                                type="submit" 
                                value="Guardar"
                                class="bg-green-700 py-2 px-1 w-full rounded-md cursor-pointer hover:bg-green-500"
                            >
                            <input type="hidden" name="r" value="movie-edit" >
                            <input type="hidden" name="crud" value="set" >
                        </div>
                    </form>
                </div>
            </div>
            ';

            printf(
                $template_movie,
                $movie[0]['id'],
                $movie[0]['id'],
                $movie[0]['title'],
                $movie[0]['plot'],
                $movie[0]['author'],
                $movie[0]['actors'],
                $movie[0]['country'],
                $movie[0]['premiere'],
                $movie[0]['poster'],
                $movie[0]['trailer'],
                $movie[0]['rating'],
                $movie[0]['genres'],
                $status_select,
                $category_movie,
                $category_serie
            );
        }

    }
    else if ($_POST['r'] == 'movie-edit' && $_SESSION['role'] == 'ADMIN' && $_POST['crud'] == 'set') {
        $form = array(
            'id' => $_POST['id'],
            'title' => $_POST['title'],
            'plot' => $_POST['plot'],
            'author' => $_POST['author'],
            'actors' => $_POST['actors'],
            'country' => $_POST['country'],
            'premiere' => $_POST['premiere'],
            'poster' => $_POST['poster'],
            'trailer' => $_POST['trailer'],
            'rating' => $_POST['rating'],
            'genres' => $_POST['genres'],
            'status' => $_POST['status'],
            'category' => $_POST['category'],
        );

        $data = $movies_controller->set($form);

        $template = '
            <div class="container mx-auto rounded-md">
                <p class="text-center bg-green-700 text-white py-2">
                    Movie: %s Editada
                </p>
            </div>

            <script>
                window.onload  = function() {
                    reloadPage("movies");
                }
            </script>
        ';

        printf($template, $_POST['title']);
    }
    else {
        $controller = new ViewController();
        $controller->load_view('error401');
    }