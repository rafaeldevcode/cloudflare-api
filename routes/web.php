<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{CloudflareController, EntrarController, PainelController, UsuarioController};
use App\Models\Cloudflare;

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

Route::get('/adicionar/nova-conta', [CloudflareController::class, 'index']);
Route::post('/usuario/{ID}/adicionar-conta', [CloudflareController::class, 'store']);
Route::get('/cloudflare/{ID}/', [CloudflareController::class, 'dominios']);
Route::post('/cloudflare/{ID}/purge-all', [CloudflareController::class, 'purgeAll']);
Route::post('/cloudflare/{ID}/purge', [CloudflareController::class, 'purge']);
Route::post('/cloudflare/{ID}/purge-urls-selecionadas', [CloudflareController::class, 'purgeUrlsSelecionadas']);
Route::get('/cloudflare/{ID}/adicionar-tag', [CloudflareController::class, 'adicionarTag']);

Route::get('/painel/perfil/{nomeUsuario}', [UsuarioController::class, 'index']);
Route::post('/painel/perfil/{ID}/adicionar-imagen', [UsuarioController::class, 'store']);