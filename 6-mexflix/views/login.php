<?php

    print('
        <div class="flex justify-center mt-5">
            <form method="post" class="space-y-2">
                <div>
                    <input 
                        type="text" 
                        name="user" 
                        placeholder="usuario" 
                        required 
                        class="border border-gray-600 p-1 rounded-sm text-black"
                    >
                </div>
                <div>
                    <input 
                        type="password"
                        name="password" 
                        placeholder="password" 
                        required
                        class="border border-gray-600 p-1 rounded-sm text-black"
                    >
                </div>
                <div>
                    <input 
                        type="submit"
                        value="Enviar"
                        class="bg-red-700 w-full p-1 rounded-sm text-white"
                    >
                </div>
            </form>
        </div>
    ');

    if(isset($_GET['error'])) {
        $template = '
            <div class="container mx-auto mt-4">
                <p class="error p-2 text-center rounded-md">
                    %s
                </p>
            </div>
        ';

        printf($template, $_GET['error']);
    }