<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use Exception;
use Illuminate\Http\Request;

class ContasController extends Controller
{
    public function index()
    {
        $contas = Conta::all();

        if (count($contas) == 0) {
            return "Não existe contas cadastradas no momento";
        } else {
            $conta =  Conta::with('pessoa')->get();

            return $conta;
        }
    }

    public function cadastrar(Request $request)
    {
        try {

            $conta =  Conta::create($request->all());
            if ($conta) {
                return response()->json([
                    'message' => 'Registro inserido com sucesso'
                ], 200);
            }
        } catch (Exception) {

            return response()->json([
                'error' => 'Preencha os campos corretamente'
            ], 500);
        }
    }

    public function editar(Request $request, $id)
    {
        $conta = Conta::find($id);

        if ($conta) {

            $conta->update($request->all());
            return response()->json([
                'message' => 'Registro alterado com sucesso'
            ], 200);
        } else {
            return response()->json([
                'error' => 'Preencha os campos corretamente'
            ], 500);
        }
    }

    public function deletarRegistro($id)
    {

        $conta = Conta::find($id);

        if ($conta) {
            $conta->delete();
            return response()->json([
                'message' => 'Registro deletado com sucesso'
            ], 200);
        } else {
            return response()->json([
                'error' => 'Esse registro não existe'
            ], 500);
        }
    }
}
