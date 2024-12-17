<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Contracts\Validation\Validator;

class StudentController extends Controller
{
    public function index() {
        $students = Student::all();

        if ($students->isEmpty()) {
            $data = [
                'message' => 'No se encontraron estudiantes',
                'status' => 200,
                'data' => $students,
            ];

            return response()->json($data, 200);
        }

        $data = [
            'status' => 200,
            'data' => $students
        ];

        return response()->json($data, 200);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:student',
            'phone' => 'required|digits:9',
            'languaje' => 'required|in:React,Angular,Vue',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400,
            ];

            return response()->json($data, 400);
        }

        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'languaje' => $request->languaje
        ]);

        if (!$student) {
            $data = [
                'message' => 'Error al crear el estudiante',
                'status' => 500
            ];

            return response()->json($data, 500);
        }

        $data = [
            'status' => 201,
            'data' => $student,
        ];

        return response()->json($data, 201);
    }

    public function show($id) {
        $student = Student::find($id);

        if (!$student) {
            $data = [
                'message' => 'Student Not Found',
                'status' => 404,
            ];

            return response()->json($data, 404);
        }

        $data = [
            'status' => 200,
            'data' => $student,
        ];

        return response()->json($data, 200);
    }

    public function destroy($id) {
        $student = Student::find($id);

        if (!$student) {
            $data = [
                'message' => 'Student not Found',
                'status' => 404,
            ];

            return response()->json($data, 404);
        }

        $student->delete();

        $data = [
            'message' => 'Student Delete',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function update(Request $request, $id) {
        $student = Student::find($id);

        if (!$student) {
            $data = [
                'message' => 'Student not Found',
                'status' => 404,
            ];

            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:student',
            'phone' => 'required|digits:9',
            'languaje' => 'required|in:React,Angular,Vue',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400,
            ];

            return response()->json($data, 400);
        }

        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->languaje = $request->languaje;

        $student->save();

        $data = [
            'message' => 'Student Updated',
            'data' => $student,
            'status' => 200,
        ];

        return response()->json($data, 200);
    }

    public function updatePartial(Request $request, $id) {
        $student = Student::find($id);

        if (!$student) {
            $data = [
                'message' => 'Student not Found',
                'status' => 404,
            ];

            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'max:255',
            'email' => 'email|unique:student',
            'phone' => 'digits:9',
            'languaje' => 'in:React,Angular,Vue',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400,
            ];

            return response()->json($data, 400);
        }

        if ($request->has('name')) {
            $student->name = $request->name;
        }

        if ($request->has('email')) {
            $student->email = $request->email;
        }

        if ($request->has('phone')) {
            $student->phone = $request->phone;
        }

        if ($request->has('languaje')) {
            $student->languaje = $request->languaje;
        }

        $student->save();

        $data = [
            'message' => 'Student Updated',
            'data'=> $student,
            'status' => 200,
        ];

        return response()->json($data, 200);
    }
}
