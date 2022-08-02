<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Endereco;
use Exception;

class EnderecosController extends Controller
{
    public function index()
    {
        $enderecos = Endereco::all();

        if (count($enderecos) == 0) {
            return "Não existe endereços cadastradas no momento";
        } else {
            return $enderecos;
        }
    }

    public function cadastrar(Request $request)
    {
        try {

            Endereco::create($request->all());

            return response()->json([
                'message' => 'Registro inserido com sucesso'
            ], 200);
        } catch (Exception) {

            return response()->json([
                'error' => 'Preencha os campos corretamente'
            ], 500);
        }
    }

    public function editar(Request $request, $id)
    {
        $endereco = Endereco::find($id);

        if ($endereco) {

            $endereco->update($request->all());
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

        $endereco = Endereco::find($id);

        if ($endereco) {
            $endereco->delete();
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
