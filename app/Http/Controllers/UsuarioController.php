<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('Autenticador');
    }

    public function index()
    {
        $usuario = Auth::user();

        return view('painel/usuario/index', compact('usuario'));
    }

    public function store(Request $request, int $ID)
    {
        $usuario = User::find($ID);

        $usuario->image_usuario = $request->file('image_usuario')->store('galeria');

        return redirect("/painel/perfil/rafael-vieira");
    }
}
