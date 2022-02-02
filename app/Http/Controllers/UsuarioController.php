<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidacaoImagem;
use App\Models\User;
use App\Services\Adicionar;
use App\Services\Editar;
use App\Services\Remover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('Autenticador');
    }

    /////////// PAINEL DE USUÁRIO ////////////
    public function index(Request $request)
    {
        $usuario = Auth::user();
        $usuarios = User::all();
        $mensagem = $request->session()->get('mensagem');

        return view('painel/usuario/index', compact('usuario', 'mensagem', 'usuarios'));
    }

    /////////// ATUALIZAR FOTO DO PERFIL //////////
    public function store(ValidacaoImagem $request, Adicionar $adicionar, int $ID)
    {
        $usuario = str_replace(' ', '-', strtolower(Auth::user()->name));
        $adicionar->adicionarImagenUsuario($request, $ID);
        $request->session()->flash('mensagem', 'Foto atualizada com sucesso!');

        return redirect("/painel/perfil/{$usuario}");
    }

    ///////////// ATUALIZAR USUÁRIO /////////
    public function editar(Request $request, int $ID, Editar $editar)
    {
        $usuario = User::find($ID);
        $editar->editarUsuario($request, $usuario);
        $request->session()->flash('mensagem', 'Usuário atualizado com sucesso!');
        !empty($request->password) ? Auth::logout() : '';

        return redirect()->back();
    }

    ////////////// REMOVER CONTA //////////////////
    public function destroy(int $ID, Remover $remover)
    {
        $remover->removerConta($ID);

        return redirect('/');
    }
}
