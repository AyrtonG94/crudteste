<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use App\Models\Movimento;
use Exception;
use Faker\Core\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MovimentosController extends Controller
{
    public function index()
    {
        $movimentos = Movimento::with('conta', 'pessoa')->get();

        if (count($movimentos) == 0) {
            return "Não existe movimentos registrados no momento";
        } else {
            return $movimentos;
        }
    }

    public function cadastrar(Request $request)
    {
        $validar = Validator::make($request->all(), [
            'valor' => 'numeric',
        ]);

        if (count($validar->errors()) != 0) {
            return response()->json([
                $validar->errors()
            ], 400);
        }

        if ($request->status == '0') {

            $conta = Conta::find($request->conta_id);
            $conta->saldo += $request->valor;
            $conta->save();
            Movimento::create($request->all());
            return response()->json([
                ['Mensagem' => 'Depósito efetuado com sucesso']
            ]);
        }
        if ($request->status == '1') {
            $conta = Conta::find($request->conta_id);
            if($conta->saldo <  $request->valor) {
                return response()->json([
                    ['Mensagem' => 'Você não tem saldo suficiente']
                ], 406);
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
