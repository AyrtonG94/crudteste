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
            return $pessoa;
        } catch (Exception) {
            return "Não  foi possível criar o cadastro, preencha todos os campos corretamente";
        }
    }

    public function editar(Request $request, $id)
    {

        $pessoa = Pessoa::find($id);
        if ($pessoa) {

            $pessoa->update($request->all());
            return $pessoa . "Dados alterados com sucesso";
        } else {
            return "Essa pessoa não existe em nossa base de dados";
        }
    }

    public function deletarRegistro($id)
    {
        $pessoa = Pessoa::find($id);

        if ($pessoa) {
            $pessoa->delete();
            return $pessoa . "Registro deletado com sucesso";
        } else {
            return "Essa pessoa não existe em nossa base de dados";
        }
    }
}
