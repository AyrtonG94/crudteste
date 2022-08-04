<?php

namespace App\Http\Controllers;

use App\Models\Conta;
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
        }

        if ($request->status == false) {

            $conta = Conta::find($request->conta_id);
            $conta->saldo += $request->valor;
            $conta->save();
            Movimento::create($request->all());
            return response()->json([
                ['Mensagem' => 'Depósito efetuado com sucesso']
            ]);
        } else {
            $conta = Conta::find($request->conta_id);
            if ($conta->saldo < $request->valor) {
                return "Você não tem salvo suficiente";
            }
            $conta->saldo -= $request->valor;
            $conta->save();
            Movimento::create($request->all());
            return response()->json([
                ['Mensagem' => 'Retirada efetuado com sucesso']
            ]);
        }
    }
}
