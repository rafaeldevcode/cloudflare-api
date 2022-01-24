<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PainelController extends Controller
{

    public function __construct()
    {
        $this->middleware('Autenticador');
    }

    public function index(Request $request)
    {
        $usuario = Auth::user();
        $usuarios = User::all();
        $contas = $usuario->cloudflare;
        $mensagem = $request->session()->get('mensagem');

        return view('painel/index', compact('usuario', 'usuarios', 'contas', 'mensagem'));
    }
}
