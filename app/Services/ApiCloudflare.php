<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiCloudflare{

    ////////// PEGAR TODOS OS DOMINIOS POR PAGINACAO ////////////
    public function getZones($conta, $page)
    {
        $response = Http::withHeaders([
            'X-Auth-Key'   => $conta->chave_api,
            'X-Auth-Email' => $conta->email,
            'Content-Type' => 'application/json'
        ])->get("https://api.cloudflare.com/client/v4/zones/?page={$page}");

        return $response;
    }

    /////////// LIMAPAR CACHE DO DOMINIO ////////////////
    public function purgeAll($conta, $id)
    {
        $response = Http::withHeaders([
            'X-Auth-Key'   => $conta->chave_api,
            'X-Auth-Email' => $conta->email,
            'Content-Type' => 'application/json'
        ])->post("https://api.cloudflare.com/client/v4/zones/{$id}/purge_cache/", [
            'purge_everything' => true
        ]);

        $response = json_decode($response, true);
        $mensagem = $response['success'] == true ? 'Cache limpado com sucesso!' : 'Erro na solicitação!';
        
        return $mensagem;
    }

    //////////// LIMPAR VARIOS ARQUIVOS SELECIONADOS /////////////////////
    public function purgePorUrl($conta, $id, $urls)
    {
        $response = Http::withHeaders([
            'X-Auth-Key'   => $conta->chave_api,
            'X-Auth-Email' => $conta->email,
            'Content-Type' => 'application/json'
        ])->post("https://api.cloudflare.com/client/v4/zones/{$id}/purge_cache/", [
            'files' => $urls
        ]);

        $response = json_decode($response, true);
        $mensagem = $response['success'] == true ? 'Cache limpado com sucesso!' : 'Erro na solicitação!';

        return $mensagem;
    }


    //////// LIMPAR CACHE POR URLS SELECIONADAS ////////////
    public function purgeUrlsSelecionadas($conta, $urls)
    {
        $responses = [];

        foreach($urls as $url){
            $response = Http::withHeaders([
                'X-Auth-Key'   => $conta->chave_api,
                'X-Auth-Email' => $conta->email,
                'Content-Type' => 'application/json'
            ])->post("https://api.cloudflare.com/client/v4/zones/{$url}/purge_cache/", [
                'purge_everything' => true
            ]);
            array_push($responses, json_decode($response, true));
            sleep(2);
        }

        return $responses;
    }

    //////////// PEGAR TODOS OS DOMINIOS //////////////
    public function getAllDominios($conta)
    {
        $total_pages = $this->retornarTotalPaginas($conta);
        $responses = [];

        for ($i = 0; $i  < $total_pages; $i++) { 
            $response = Http::withHeaders([
                'X-Auth-Key'   => $conta->chave_api,
                'X-Auth-Email' => $conta->email,
                'Content-Type' => 'application/json'
            ])->get("https://api.cloudflare.com/client/v4/zones/?page={$total_pages[$i]}")['result'][$i]['name'];
            array_push($responses, $response);
        }

        return $responses;
    }

    private function retornarTotalPaginas($conta)
    {
        $total_pages = Http::withHeaders([
            'X-Auth-Key'   => $conta->chave_api,
            'X-Auth-Email' => $conta->email,
            'Content-Type' => 'application/json'
        ])->get("https://api.cloudflare.com/client/v4/zones/")['result_info']['total_pages'];

        return $total_pages;
    }
}