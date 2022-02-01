<?php

namespace App\Http\Controllers;

use App\Models\Cloudflare;
use App\Models\Tag;
use App\Services\Adicionar;
use App\Services\ApiCloudflare;
use App\Services\Editar;
use App\Services\Remover;
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
        $mensagens = $request->session()->get('mensagens');
        $mensagem = $request->session()->get('mensagem');
        $aviso = 'Nenhuma tag cadastrada para esta conta!';

        return view('painel/tags/index', compact('usuario', 'conta', 'tags', 'mensagens', 'mensagem', 'aviso'));
    }

    ///////// LIMPAR CACHE DA TAG ////////
    public function limparTag(int $ID, Request $request, ApiCloudflare $conectar)
    {
        $urls = explode(',', $request->id_dominio);
        $conta = Cloudflare::find($request->id_cloudflare);
        $response = $conectar->purgeUrlsSelecionadas($conta, $urls);
        $request->session()->flash('mensagens', $response);

        return redirect()->back();
    }

    ///////// REMOVER TAG /////////
    public function destroy(int $ID, Remover $remover, Request $request)
    {
        $tag =  Tag::find($ID)->nome;
        $remover->removerTag($ID);
        $request->session()->flash("mensagem", "Tag {$tag} removida com sucesso!");

        return redirect()->back();
    }

    /////// EDITAR TAG //////////
    public function editar(int $ID, Request $request, Editar $editar)
    {
        $editar->editarTag($ID, $request);
        $request->session()->flash('mensagem', 'Tag editada com sucesso!');

        return redirect()->back();
    }
}
