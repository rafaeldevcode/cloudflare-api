<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{EntrarController, PainelController, UsuarioController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [EntrarController::class, 'index']);
Route::post('/registrar', [EntrarController::class, 'store']);
Route::post('/entrar', [EntrarController::class, 'entrar']);
Route::get('/sair', [EntrarController::class, 'logout']);

Route::get('/painel', [PainelController::class, 'index']);
Route::get('/adicionar/nova-conta', [PainelController::class, 'novaConta']);

Route::get('/painel/perfil/{nomeUsuario}', [UsuarioController::class, 'index']);
Route::post('/painel/perfil/{ID}/adicionar-imagen', [UsuarioController::class, 'store']);