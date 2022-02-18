<?php

namespace App\Http\Controllers;

use App\Models\Cloudflare;
use App\Services\ApiCloudflare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesquisarController extends Controller
{

    private $aviso = 'Não encontramos nada relacionado a sua pesquisa!';
    private $mensagem = 'Resultados de pesquisa para';

    public function __construct()
    {
        $this->middleware('Autenticador');
    }

    //////// PESQUISAR POR TAG /////////
    public function pesquisarTag(int $ID, Request $request)
    {
        $usuario = Auth::user();
        $conta = Cloudflare::find($ID);
        $mensagens = $request->session()->get('mensagens');
        $mensagem = "{$this->mensagem} '{$request->pesquisar}'";
        $aviso = $this->aviso;
        $tags = $conta->tags()->where('nome', 'LIKE', "%{$request->pesquisar}%")->get();

        return view('painel/tags/index', compact('usuario', 'conta', 'tags', 'mensagens', 'mensagem', 'aviso'));
    }

    //////// PESQUISAR POR DOMINÍOS /////////
    public function pesquisarDominios(int $ID, Request $request, ApiCloudflare $conectar)
    {
        $usuario = Auth::user();
        $conta = Cloudflare::find($ID);
        $response = $conectar->retornarPesquisaPorDominio($conta, $request);

        $mensagem = "{$this->mensagem} '{$request->pesquisar}'";
        $aviso = $this->aviso;

        return view('painel/cloudflare/index', compact('usuario', 'conta', 'response', 'mensagem', 'aviso'));
    }
}
