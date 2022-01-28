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

        return view('painel/tags/create', compact('usuario', 'conta', 'resultados', 'mensagem'));
    }

    /////// GUARDAR TAG NO BANCO //////////////////
    public function store(Request $request, int $ID, Adicionar $adicionar)
    {
        $adicionar->adicionarTag($request, $ID);
        $request->session()->flash('mensagem', 'Tag adicionada com sucesso!');

        return redirect()->back();
    }

    ////////// VISUALIZAR TAGS CADASTRADAS //////////
    public function index(int $ID, Request $request)
    {
        $usuario = Auth::user();
        $conta = Cloudflare::find($ID);
        $tags = $conta->tags()->get();
        $mensagem = $request->session()->get('mensagem');

        return view('painel/tags/index', compact('usuario', 'conta', 'tags', 'mensagem'));
    }
}
