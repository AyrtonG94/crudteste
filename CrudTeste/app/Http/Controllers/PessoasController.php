<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;
use Exception;


class PessoasController extends Controller
{
    public function index()
    {
        $pessoas = Pessoa::all();

        if (count($pessoas) == 0) {
            return "Não existe pessoas cadastradas no momento";
        } else {
            return $pessoas;
        }
    }

    public function cadastrar(Request $request)
    {
        try {

            $pessoa =  Pessoa::create($request->all());
            if ($pessoa) {
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
        $pessoa = Pessoa::find($id);

        if ($pessoa) {

            $pessoa->update($request->all());
            return response()->json([
                'message' => 'Registro alterado com sucesso'
            ], 200);
        } else {
            return response()->json([
                'error' => 'Preencha os campos corretamente'
            ], 500);
        }
    }

    public function deletarRegistro(Request $request, $id)
    {

        $pessoa = Pessoa::find($id);

        if ($pessoa) {
            $pessoa->delete();
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
