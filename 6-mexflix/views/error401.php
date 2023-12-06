<?php

    print('
        <h2 class="error text-center p-4 font-semibold rounded-md">Error 401: No tienes Autorización para este recurso</h2>
        <div class="mt-4 flex justify-center">
            <input 
                type="button"
                value="Regresar"
                class="bg-green-700 py-2 px-3 rounded-md cursor-pointer hover:bg-green-500"
                onclick="history.back()" 
            >
        </div>
    ');