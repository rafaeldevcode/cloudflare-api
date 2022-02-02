<?php

namespace App\Http\Controllers;

use App\Models\Cloudflare;
use App\Services\ApiCloudflare;
use Illuminate\Http\Request;

class PurgeController extends Controller
{
    public function index(int $ID, Request $request, ApiCloudflare $conectar)
    {
        $conta = Cloudflare::find($ID);
        $dominio = empty($request->query('dominio')) ? '' : $request->query('dominio');
        if(empty($conta)){
            $mensagem = 'Não existe nenhuma conta com esse ID!';
            return view('painel/purgeUrl/index', compact('dominio', 'mensagem', 'conta'));
        }
        $mensagem = $conectar->limparDominioPorParametro($conta, $request, $dominio);

        return view('painel/purgeUrl/index', compact('dominio', 'mensagem', 'conta'));
    }


}
