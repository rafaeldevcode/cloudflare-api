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

    public function index()
    {
        $usuario = Auth::user();
        $usuarios = User::all();

        return view('painel/index', compact('usuario', 'usuarios'));
    }

    public function novaConta()
    {
        $usuario = Auth::user();

        return view('painel/novaConta', compact('usuario'));
    }
}
