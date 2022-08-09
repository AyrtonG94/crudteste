<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Endereco;
use Illuminate\Support\Facades\Validator;

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
        $validar = Validator::make($request->all(),[
            'cep' => 'required|min:8|numeric',
            'numero' => 'max:4',
            'logradouro' => 'required',
            'bairro' => 'required',
            'uf' => 'required|min:2|max:2',
            'municipio' => 'required',
        ]);

        if(count($validar->errors()) !=0) {
            return $validar->errors();
        } else {
            Endereco::create($request->all());
            return response()->json([
                'Mensagem' => 'Registro cadastrado com sucesso'
            ], 200);
            
        }
    }

    public function editar(Request $request, $id)
    {
        $endereco = Endereco::find($id);
        $validar = Validator::make($request->all(), [
            'cep' => 'min:8|max:8|numeric',
            'uf' => 'min:2|max:2',
        ]);

        if(count($validar->errors()) != 0) {
            return $validar->errors();
        } 
        elseif(!$endereco) {
            return response()->json([
                'Mensagem' => 'Esse registro não existe'
            ], 500);
        } 
        else {
            $endereco->update($request->all());
            return response()->json([
                'Mensagem' => 'Registro alterado com sucesso'
            ], 200);
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
