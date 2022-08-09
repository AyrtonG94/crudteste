<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;
use App\Models\Pessoa;
use Illuminate\Support\Facades\Validator;

class PessoasController extends Controller
{
    public function index()
    {
        $pessoa = Pessoa::with('endereco')->get();
        if (count($pessoa) == 0) {
            return "Não existe pessoas cadastradas no momento";
        } else {
            return $pessoa;
        }
    }


    public function cadastrar(Request $request)
    {
        $validar = Validator::make($request->all(), [
            'nome' => 'required|min:3|max:50|',
            'cpf' => 'required|min:11|unique:pessoas|numeric',
            'cep' => 'required|min:8|numeric',
            'numero' => 'min:1|numeric',
            'logradouro' => 'required|max:100',
            'bairro' => 'required|max:45',
            'complemento' => 'max:50',
            'uf' => 'required|max:2',
            'municipio' => 'required|max:45'
        ]);

        $pessoa = new Pessoa;
        $pessoa->nome = $request->nome;
        $pessoa->cpf = $request->cpf;

        $validar_nome = preg_match('|^[\pL\s]+$|u', $pessoa->nome);

        if (count($validar->errors()) != 0) {
            return $validar->errors();
        } elseif (!$validar_nome) {
            return "O nome só pode conter letras";
        } else {
            $pessoa->nome = mb_convert_case($pessoa->nome, MB_CASE_TITLE, "UTF-8");

            $pessoa->save();

            $endereco = new Endereco;
            $endereco->cep = $request->cep;
            $endereco->numero = $request->numero;
            $endereco->logradouro = $request->logradouro;
            $endereco->bairro = $request->bairro;
            $endereco->complemento = $request->complemento;
            $endereco->uf = $request->uf;
            $endereco->municipio = $request->municipio;
            $endereco->pessoa_id = $pessoa->id;
            $endereco->save();
        }
    }


    public function editar(Request $request, $id)
    {

        $validar = Validator::make($request->all(), [
            'nome' => 'min:3|max:50|',
            'cpf' => 'min:11|numeric|unique:pessoas,cpf,' . $id
        ]);

        $pessoa = Pessoa::find($id);

        if (count($validar->errors()) != 0) {
            return $validar->errors();
        } elseif (!$pessoa) {
            return response()->json([
                'error' => 'Esse registro não existe'
            ], 500);
        } else {
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
