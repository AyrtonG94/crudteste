<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PessoasController;
use App\Http\Controllers\ContasController;
use App\Http\Controllers\EnderecosController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('pessoas')->group(function () {
    Route::get('index', [PessoasController::class, 'index']);
    Route::post('cadastrar', [PessoasController::class, 'cadastrar']);
    Route::put('editar/{id}', [PessoasController::class, 'editar']);
    Route::delete('deletar-registro/{id}', [PessoasController::class, 'deletarRegistro']);
});

Route::prefix('contas')->group(function () {
    Route::get('index', [ContasController::class, 'index']);
    Route::post('cadastrar', [ContasController::class, 'cadastrar']);
    Route::put('editar/{id}', [ContasController::class, 'editar']);
    Route::delete('deletar-registro/{id}', [ContasController::class, 'deletarRegistro']);
});

Route::prefix('enderecos')->group(function () {
    Route::get('index', [EnderecosController::class, 'index']);
    Route::post('cadastrar', [EnderecosController::class, 'cadastrar']);
    Route::put('editar/{id}', [EnderecosController::class, 'editar']);
    Route::delete('deletar-registro/{id}', [EnderecosController::class, 'deletarRegistro']);
});
