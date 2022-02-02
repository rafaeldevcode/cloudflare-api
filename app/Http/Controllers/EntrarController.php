<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidacaoUsuario;
use App\Services\Adicionar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntrarController extends Controller
{
    public function index()
    {
        if(Auth::user()){
            return redirect('/painel');
        }
        
        return view('entrar/index');
    }

    public function store(ValidacaoUsuario $request, Adicionar $adicionar)
    {
        $adicionar->adidionarUsuario($request);
        return redirect('/painel');
    }

    public function entrar(Request $request)
    {
        $user = $request->except('_token');

        if(Auth::attempt($user)){
            $request->session()->regenerate();

            return redirect()->intended('/painel');
        }

        return back()->withErrors('Email e/ou senhas inválidos!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
