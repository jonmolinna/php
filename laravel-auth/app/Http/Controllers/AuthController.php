<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
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

        $credentials = $request->only('email', 'password');

        // if ($token = JWTAuth::attempt($credentials)) {
        //     return response()->json(['token' => $token]);
        // }
        // return response()->json(['error' => 'Unauthorized'], 401);

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }

        return response()->json(['token' => $token]);
    }

    public function logout() {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function me() {
        try {
            // Verifica si el token es válido y obtiene el usuario autenticado
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'Usuario no autenticado'], 401);
            }
    
            return response()->json($user);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token no proporcionado o es inválido'], 500);
        }
    }
}
