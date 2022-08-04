<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $validar = Validator::make($request->all(), [
            'conta' => 'required|min:8|numeric|unique:contas',
            'pessoa_id' => 'required',
        ]);

        if (count($validar->errors()) != 0) {
            return $validar->errors();
        } else {
            Conta::create($request->all());
            return response()->json([
                'Mensagem' => 'Registro criado com sucesso'
            ]);
        }
    }


    public function editar(Request $request, $id)
    {
        $validar = Validator::make($request->all(), [
            'conta' => 'min:8|max:8|numeric',
        ]);

        $conta = Conta::find($id);

        if (count($validar->errors()) != 0) {
            return $validar->errors();
        } 
        elseif (!$conta) {
            return response()->json([
                'error' => 'Esse registro não existe'
            ], 500);
        } 
        else {
            $conta->update($request->all());
            return response()->json([
                'Mensagem' => 'Registro alterado com sucesso'
            ], 200);
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
