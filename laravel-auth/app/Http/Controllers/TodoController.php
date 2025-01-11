<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Todo;

class TodoController extends Controller
{
   public function store(Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required',
    ]);

    if ($validator->fails()) {
        $data = [
            'message' => 'Error en la validacion de los datos',
            'errors' => $validator->errors(),
            'status' => 400,
        ];

        return response()->json($data, 400);
    }

    $todo = Todo::create([
        'name' => $request->name,
        'message' => 1
    ]);

    if (!$todo) {
        $message = [
            'message' => 'Error al crear la tarea',
            'status' => 500
        ];

        return response()->json($message, 500);
    }

    $data = [
        'status' => 201,
        'data' => $todo,
    ];

    return response()->json($data, 201);
   }
}
