<?php

namespace App\Http\Controllers;

use App\Models\Movimento;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MovimentosController extends Controller
{
    public function index()
    {
        $movimentos = Movimento::all();

        if (count($movimentos) == 0) {
            return "Não existe movimentos registrados no momento";
        } else {
            return Movimento::with('conta', 'pessoa')->get();
        }
    }

    public function cadastrar(Request $request)
    {
        $validar = Validator::make($request->all(), [
            'valor' => 'numeric',
        ]);
        if (count($validar->errors()) != 0) {
            return $validar->errors();
        } else {
            Movimento::create($request->all());
            return response()->json([
                'mensagem' => 'Registro criado com sucesso'
            ], 200);
        }
    }
}
