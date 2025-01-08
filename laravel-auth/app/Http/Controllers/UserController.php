<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
   public function store(Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required'
    ]);

    if ($validator->fails()) {
        $data = [
            'message' => 'Error en la validacion de los datos',
            'errors' => $validator->errors(),
            'status' => 400,
        ];

        return response()->json($data, 400);
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => $request->password
    ]);

    if (!$user) {
        $message = [
            'message' => 'Error al crear el estudiante',
            'status' => 500
        ];

        return response()->json($data, 500);
    }

    $data = [
        'status' => 201,
        'data' => $user,
    ];

    return response()->json($data, 201);

   }
}
