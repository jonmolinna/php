<?php

    if ($_POST['r'] == 'movie-add' && $_SESSION['role'] == 'ADMIN' && !isset($_POST['crud'])) {
        print('
        <div class="flex justify-center">
            <div>
                <h2 class="text-xl text-center mb-4">
                    Agregar Status
                </h2>
                <form method="POST" class="space-y-3">

                </form>
            </div>
        </div>
        ');
    }

    // 2:35