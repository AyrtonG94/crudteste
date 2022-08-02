<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PessoasController;

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

Route::prefix('pessoas')->group(function() {
    Route::get('index', [PessoasController::class, 'index']);
    Route::post('cadastrar', [PessoasController::class, 'cadastrar']);
    Route::put('editar/{id}', [PessoasController::class, 'editar']);
    Route::delete('deletar-registro/{id}', [PessoasController::class, 'deletarRegistro']);
});
