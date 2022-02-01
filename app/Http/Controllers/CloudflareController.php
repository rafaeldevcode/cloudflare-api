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
    public function create()
    {
        $usuario = Auth::user();

        return view('painel/cloudflare/create', compact('usuario'));
    }

    ///////////// GUARDAR CONTA NO BD ////////////
    public function store(Request $request, int $ID, Adicionar $adicionar)
    {
        $adicionar->adicionarContaCloudflare($request, $ID);
        $request->session()->flash('mensagem', 'Conta adicionada com sucesso!');

        return redirect('/painel');
    }

    //////// LISTAR OS DOMINIOS - PAGINAÇÃO //////////
    public function index(int $ID, ApiCloudflare $conectar, Request $request)
    {
        $usuario = Auth::user();
        $conta = Cloudflare::find($ID);
        $mensagem = $request->session()->get('mensagem');
        $aviso = 'Nenhum domínio cadastrado para esta conta!';
        $page = empty($request->query('page')) ? 1 : $request->query('page');

        $response = json_decode($conectar->getZones($conta, $page), true);

        return view('painel/cloudflare/index', compact('usuario', 'conta', 'response', 'mensagem', 'aviso'));
    }

    /////////// LIMPAR O CACHE DO DOMINIO //////////
    public function purgeAll(int $ID, ApiCloudflare $conectar, Request $request)
    {
        $conta = Cloudflare::find($ID);
        $id_dominio = $request->id_dominio;
        $response = $conectar->purgeAll($conta, $id_dominio);

        if($response == true){
            $request->session()->flash('mensagem', 'Cache limpado com sucesso!');

            return redirect()->back();
        }else{
            return redirect()->back()->withErrors('Erro ao efetuar a limpeza de cache! Se persistir contate o suporte.');
        }
    }

    ///////// LIMPAR CACHE DAS URLS FORNECIDAS //////////
    public function purge(int $ID, Request $request, ApiCloudflare $conectar)
    {
        $conta = Cloudflare::find($ID);
        $id_dominio = $request->id_dominio;
        $urls = explode("\r\n", $request->urls);
        $response = $conectar->purgePorUrl($conta, $id_dominio, $urls);

        if($response == 1){
            $request->session()->flash('mensagem', 'cache Limpado com sucesso!');

            return redirect()->back();
        }else{
            return redirect()->back()->withErrors('Erro ao efetuar a limpeza de cache! Verifique se a url está correta.');
        }
    }

    ////////// LIMPAR CACHES POR URLS SELECIONADAS /////////
    public function purgeUrlsSelecionadas(int $ID, Request $request, ApiCloudflare $conectar)
    {
        $conta = Cloudflare::find($ID);
        $urls[] = $request->urls;
        $conectar->purgeUrlsSelecionadas($conta, $urls);
    }
}
