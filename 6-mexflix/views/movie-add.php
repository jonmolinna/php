<?php

    if ($_POST['r'] == 'movie-add' && $_SESSION['role'] == 'ADMIN' && !isset($_POST['crud'])) {
        $status_controller = new StatusController();
        $status = $status_controller->get();
        $status_select = '';

        for ($i=0; $i < count($status); $i++) {
            $status_select .= '<option value="' .$status[$i]['id'] . '">' . $status[$i]['status'] . '</option>';
        }

        printf('
        <div class="flex justify-center">
            <div>
                <h2 class="text-xl text-center mb-4">
                    Agregar Movie
                </h2>
                <form method="POST" class="mb-10 grid grid-cols-4 gap-4">
                    <div>
                        <input 
                            type="text" 
                            name="id" 
                            placeholder="Id" 
                            required
                            class="py-2 px-1 text-black"
                        >
                    </div>
                    <div>
                        <input 
                            type="text" 
                            name="title" 
                            placeholder="Title" 
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
                        ></textarea> 
                    </div>
                    <div>
                        <input 
                            type="text" 
                            name="author" 
                            placeholder="Autor" 
                            required
                            class="py-2 px-1 text-black"
                        >
                    </div>
                    <div>
                        <input 
                            type="text" 
                            name="actors" 
                            placeholder="Actores" 
                            required
                            class="py-2 px-1 text-black"
                        >
                    </div>
                    <div>
                        <input 
                            type="text" 
                            name="country" 
                            placeholder="Pais" 
                            required
                            class="py-2 px-1 text-black"
                        >
                    </div>
                    <div>
                        <input 
                            type="text" 
                            name="premiere" 
                            placeholder="Estreno" 
                            required
                            class="py-2 px-1 text-black"
                        >
                    </div>
                    <div>
                        <input 
                            type="url" 
                            name="poster" 
                            placeholder="Poster" 
                            required
                            class="py-2 px-1 text-black"
                        >
                    </div>
                    <div>
                        <input 
                            type="url" 
                            name="trailer" 
                            placeholder="Trailer" 
                            required
                            class="py-2 px-1 text-black"
                        >
                    </div>
                    <div>
                        <input 
                            type="number" 
                            name="rating" 
                            placeholder="Rating" 
                            required
                            class="py-2 px-1 text-black"
                        >
                    </div>
                    <div>
                        <input 
                            type="text" 
                            name="genres" 
                            placeholder="Géneros" 
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
                            <input type="radio" name="category" id="movie" value="Movie" required />
                            <label for="movie">Movie</label>
                        </div>
                        <div>
                            <input type="radio" name="category" id="serie" value="Serie" required />
                            <label for="serie">Serie</label>
                        </div>
                    </div>
                    <div class="order-2">
                        <input 
                            type="submit" 
                            value="Agregar"
                            class="bg-green-700 py-2 px-1 w-full rounded-md cursor-pointer hover:bg-green-500"
                        >
                        <input type="hidden" name="r" value="movie-add" >
                        <input type="hidden" name="crud" value="set" >
                    </div>
                </form>
            </div>
        </div>
        ', $status_select);
    }
    else if ($_POST['r'] == 'movie-add' && $_SESSION['role'] == 'ADMIN' && $_POST['crud'] == 'set') {
        $movie_controller = new MoviesController();

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

        $movie = $movie_controller->set($form);

        $template = '
            <div class="container mx-auto rounded-md">
                <p class="text-center bg-green-700 text-white py-2">
                    Movie: %s guardado
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