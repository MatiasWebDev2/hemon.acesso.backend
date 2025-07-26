<?php

namespace App\Http\Controllers;

use App\Models\Register;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegistrosController extends Controller
{

    public function listAllRegisters (Request $request) {

        $data = Register::all();

        return response()->json($data);
    }

    public function listByDates(Request $request) {

        $start_date = $request->start_date;
        $end_date = $request->end_date; 


        if($start_date == $end_date) {
            $registers = Register::whereDate('created_at', $start_date)->get();
            return response()->json($registers);
        }

        $registers = Register::whereBetween('created_at', [$start_date, Carbon::createFromFormat('Y-m-d', $end_date)->endOfDay()])->get();
        return response()->json($registers);


    }

    public function getById(Request $request) {

        $id = $request->id;
        $registro = Register::find($id);

        return response()->json($registro);
    }

    public function createRegister(Request $request)
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
        ], 201);
    }

    public function patchRegister(Request $request) {

        
        $request->validate([
            'hr_entrada' => 'required|string',
            'hr_saida' => 'required|string',
            'obs' => 'string'
        ]);

        $register = Register::find($request->id);

        if($register) {

            $register->hr_entrada = $request->hr_entrada;
            $register->hr_saida = $request->hr_saida;
            $register->obs = $request->obs;

            $register->save();

            return response()->json($register);
        }

        return response()->json(['success' => false, 'message' => 'not found'], 404);
    }

    public function deleteRegister(Request $request) {

        $register = Register::find($request->id);

        if($register) {
            $register->delete();

            return response()->json(['delete' => 'ok']);
        }

        return response()->json(['delete' => 'não encontrado!']);
    }
}
