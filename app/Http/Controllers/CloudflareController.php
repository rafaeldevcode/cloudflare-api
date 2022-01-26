<?php

namespace App\Http\Controllers;

use App\Models\Cloudflare;
use App\Services\{Adicionar, ApiCloudflare};
use GrahamCampbell\ResultType\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CloudflareController extends Controller
{
    public function __construct()
    {
        $this->middleware('Autenticador');
    }

    //////// CADASTRAR NOVA CONTA CLOUDFLARE ///////
    public function index()
    {
        $usuario = Auth::user();

        return view('painel/cloudflare/index', compact('usuario'));
    }

    ///////////// GUARDAR CONTA NO BD ////////////
    public function store(Request $request, int $ID, Adicionar $adicionar)
    {
        $adicionar->adicionarContaCloudflare($request, $ID);
        $request->session()->flash('mensagem', 'Conta adicionada com sucesso!');

        return redirect('/painel');
    }

    //////// LISTAR OS DOMINIOS - PAGINAÇÃO //////////
    public function dominios(int $ID, ApiCloudflare $conectar, Request $request)
    {
        $usuario = Auth::user();
        $conta = Cloudflare::find($ID);
        $mensagem = $request->session()->get('mensagem');
        $page = empty($request->query('page')) ? 1 : $request->query('page');

        $response = json_decode($conectar->getZones($conta, $page), true);

        return view('painel/cloudflare/dominios', compact('usuario', 'conta', 'response', 'mensagem'));
    }

    /////////// LIMPAR O CACHE DO DOMINIO //////////
    public function purgeAll(int $ID, ApiCloudflare $conectar, Request $request)
    {
        $conta = Cloudflare::find($ID);
        $id_cloudflare = $request->id_cloudflare;
        $response = $conectar->purgeAll($conta, $id_cloudflare);
        $request->session()->flash('mensagem', $response);

        return redirect()->back();
    }

    ///////// LIMPAR CACHE DAS URLS FORNECIDAS //////////
    public function purge(int $ID, Request $request, ApiCloudflare $conectar)
    {
        $conta = Cloudflare::find($ID);
        $id_cloudflare = $request->id_cloudflare;
        $urls = explode("\r\n", $request->urls);
        $response = $conectar->purgePorUrl($conta, $id_cloudflare, $urls);
        $request->session()->flash('mensagem', $response);

        return redirect()->back();
    }

    ////////// LIMPAR CACHES POR URLS SELECIONADAS /////////
    public function purgeUrlsSelecionadas(int $ID, Request $request, ApiCloudflare $conectar)
    {
        $conta = Cloudflare::find($ID);
        $urls[] = $request->urls;
        $conectar->purgeUrlsSelecionadas($conta, $urls);
    }

    //////// ADICIONAR TAG COM URLS PARA LIMPAR LIMPAR CACHE /////////
    public function adicionarTag(int $ID)
    {
        $usuario = Auth::user();
        $conta = Cloudflare::find($ID);

        return view('painel/cloudflare/adicionarTag', compact('usuario', 'conta'));
    }
}
