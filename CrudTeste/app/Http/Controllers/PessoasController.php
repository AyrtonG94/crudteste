<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;

class PessoasController extends Controller
{
    public function index() {

        Pessoa::all();
    }

    public function cadastrar(Request $request) {
        Pessoa::create($request->all());
    }
}
