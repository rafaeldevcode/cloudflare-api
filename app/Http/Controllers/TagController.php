<?php

namespace App\Http\Controllers;

use App\Models\Cloudflare;
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
    public function create(int $ID, ApiCloudflare $conectar)
    {
        $usuario = Auth::user();
        $conta = Cloudflare::find($ID);
        $resultados = $conectar->getAllDominios($conta);

        return view('painel/cloudflare/adicionarTag', compact('usuario', 'conta', 'resultados'));
    }
}
