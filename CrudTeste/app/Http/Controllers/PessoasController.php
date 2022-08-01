<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;
use Exception;

use function PHPUnit\Framework\isEmpty;


class PessoasController extends Controller
{
    public function index()
    {
        try {

            $pessoas = Pessoa::all();

            if (!$pessoas) {
                return "Não existe pessoas cadastradas no momento";
            } else {
                return $pessoas;
            }
        } catch (Exception) {
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
}
