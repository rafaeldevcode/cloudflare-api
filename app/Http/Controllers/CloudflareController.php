<?php

namespace App\Http\Controllers;

use App\Models\Cloudflare;
use App\Services\{Adicionar, ApiCloudflare};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CloudflareController extends Controller
{
    public function __construct()
    {
        $this->middleware('Autenticador');
    }

    public function index()
    {
        $usuario = Auth::user();

        return view('painel/cloudflare/index', compact('usuario'));
    }

    public function store(Request $request, int $ID, Adicionar $adicionar)
    {
        $adicionar->adicionarContaCloudflare($request, $ID);
        $request->session()->flash('mensagem', 'Conta adicionada com sucesso!');

        return redirect('/painel');
    }

    public function dominios(int $ID, ApiCloudflare $conectar)
    {
        $usuario = Auth::user();
        $conta = Cloudflare::find($ID);

        $response = $conectar->getApiCloudflare($conta, 'zones');
        $response = json_decode($response, true);

        return view('painel/cloudflare/dominios', compact('usuario', 'conta', 'response'));
    }

    public function purgeAll(int $ID, ApiCloudflare $conectar, Request $request)
    {
        $usuario = Auth::user();
        $conta = Cloudflare::find($ID);
        $id_cloudflare = $request->id_cloudflare;
        $response = $conectar->postApiCloudflare($conta, 'purge_cache', $id_cloudflare);

        dd($response);
    }
}
