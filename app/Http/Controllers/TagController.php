<?php

namespace App\Http\Controllers;

use App\Models\Cloudflare;
use App\Services\Adicionar;
use App\Services\ApiCloudflare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('Autenticador');
    }

    //////// ADICIONAR TAG COM URLS PARA LIMPAR LIMPAR CACHE /////////
    public function create(int $ID, ApiCloudflare $conectar, Request $request)
    {
        $usuario = Auth::user();
        $conta = Cloudflare::find($ID);
        $resultados = $conectar->getAllDominios($conta);
        $mensagem = $request->session()->get('mensagem');

        return view('painel/cloudflare/adicionarTag', compact('usuario', 'conta', 'resultados', 'mensagem'));
    }

    /////// GUARDAR TAG NO BANCO //////////////////
    public function store(Request $request, int $ID, Adicionar $adicionar)
    {
        $adicionar->adicionarTag($request, $ID);
        $request->session()->flash('mensagem', 'Tag adicionada com sucesso!');

        return redirect()->back();
    }
}
