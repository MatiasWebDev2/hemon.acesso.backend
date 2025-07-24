<?php

namespace App\Http\Controllers;

use App\Models\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegistrosController extends Controller
{

    

    public function list (Request $request) {

        return response()->json(['status' => 'ok']);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tipo_registro' => 'required|string',
            'nome' => 'required|string',
            'motivo' => 'required|string',
            'porteiro' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $register = Register::create([
            'tipo_registro' => $request->tipo_registro,
            'nome' => $request->nome,
            'motivo' => $request->motivo,
            'hr_entrada' => $request->hr_entrada,
            'hr_saida' => $request->hr_saida,
            'porteiro' => $request->porteiro,
            'obs' => $request->obs,
        ]);



        return response()->json([
            'success' => true,
            'message' => 'Registro criado com sucesso',
            'register' => $register,
        ]);
    }
}
