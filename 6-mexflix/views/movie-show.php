<?php

    if ($_POST['r'] == 'movie-show' && isset($_POST['id'])) {
        $movie_controller = new MoviesController();
        $data = $movie_controller->get($_POST['id']);

        if (empty($data)) {
            printf('
                <div class="text-center mt-3">
                    <p>Error al cargar la informacion del video: %s</p>
                </div>
            ', $_POST['id']);
        }
        else {
            $template_movie = '
                <div class="max-w-3xl mx-auto mb-10">
                    <h2 class="text-center text-2xl font-medium">%s</h2>
                    <p class="text-center">%s</p>
                    <p class="text-center">
                        <small class="block">(%s)</small>
                        <small class="block">%s</small>
                        <small class="block">%s</small>
                        <small class="block">%s</small>
                        <small class="block">%s</small>
                        <small class="block">%s</small>
                    </p>
                    <div class="mt-5 flex justify-center">
                        <img src="%s" class="w-[200px] h-auto object-cover object-center">
                    </div>
                    <p class="text-center mt-3">Author: %s</p>
                    <p>Actors: %s</p>
                    <article>%s</article>
                    <div class="my-5 flex justify-center">
                        <iframe 
                            src="%s" 
                            frameborder="0" 
                            allowfullscreen
                            class="w-[560px] h-[315px]"
                        >
                        </iframe>
                    </div>
                    <div class="flex justify-center">
                        <input 
                            type="button"
                            value="Regresar"
                            onclick="history.back()"
                            class="bg-green-700 px-3 py-1 rounded-md cursor-pointer hover:bg-green-500"
                        >
                    </div>
                </div>
            ';

            $trailer = str_replace('watch?v=', 'embed/', $data[0]['trailer']);

            printf(
                $template_movie,
                $data[0]['title'],
                $data[0]['genres'],
                $data[0]['id'],
                $data[0]['status'],
                $data[0]['category'],
                $data[0]['country'],
                $data[0]['premiere'],
                $data[0]['rating'],
                $data[0]['poster'],
                $data[0]['author'],
                $data[0]['actors'],
                $data[0]['plot'],
                $trailer,
            );
        }
    }
    else {
        $controller = new ViewController();
        $controller->load_view('error404');
    }