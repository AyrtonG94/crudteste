<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        $validar = Validator::make($request->all(), [
            'nome' => 'required|min:3',
            'cpf' => 'required|min:11|max:11|unique:pessoas'
        ]);

        if (count($validar->errors()) != 0) {
            return $validar->errors();
        } else {
            Pessoa::create($request->all());
            return response()->json([
                'Mensagem' => 'Registro criado com sucesso'
            ]);
        }
    }

    public function editar(Request $request, $id)
    {

        $validar = Validator::make($request->all(), [
            'nome' => 'min:3',
            'cpf' => 'min:11|max:11',
        ]);

        $pessoa = Pessoa::find($id);

        if (count($validar->errors()) != 0) {
            return $validar->errors();
        } 
        elseif (!$pessoa) {
            return response()->json([
                'error' => 'Esse registro não existe'
            ], 500);
        } 
        else {
            $pessoa->update($request->all());
            return response()->json([
                'Mensagem' => 'Registro alterado com sucesso'
            ]);
        }
    }


    public function deletarRegistro($id)
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
