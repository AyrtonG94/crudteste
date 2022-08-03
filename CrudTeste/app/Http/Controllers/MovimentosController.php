<?php

namespace App\Http\Controllers;

use App\Models\Movimento;
use Exception;
use Illuminate\Http\Request;

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
        try {

            Movimento::create($request->all());
            return response()->json([
                'mensagem' => 'Registro criado com sucesso'
            ]);
        } catch (Exception) {
            return response()->json([
                'mensagem' => 'Não foi possivel registrar a movimentação, preencha os dados novamente'
            ]);
        }
    }
}
