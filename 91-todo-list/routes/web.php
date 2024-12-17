<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

//----- resources -> views -> name carpeta . file 
// Muestra la vista
// Route::get('/task', function () {
//     return view('task.index');
// });

// Route::post('/task', function () {
//     print_r($_POST);
// });

// Pintar la vista
Route::get('/task', [TaskController::class, 'index']);
// Recepcionar los datos
Route::post('/task', [TaskController::class, 'store']);
Route::delete('/task/{id}', [TaskController::class, 'destroy'])->name('task.destroy');
Route::get('/task/{id}', [TaskController::class, 'edit'])->name('task.edit');
