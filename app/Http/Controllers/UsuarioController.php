<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Adicionar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('Autenticador');
    }

    public function index(Request $request)
    {
        $usuario = Auth::user();
        $mensagem = $request->session()->get('mensagem');

        return view('painel/usuario/index', compact('usuario', 'mensagem'));
    }

    public function store(Request $request, Adicionar $adicionar, int $ID)
    {

        $usuario = str_replace(' ', '-', strtolower(Auth::user()->name));
        $adicionar->adicionarImagenUsuario($request, $ID);
        $request->session()->flash('mensagem', 'Foto atualizada com sucesso!');

        return redirect("/painel/perfil/{$usuario}");
    }
}
