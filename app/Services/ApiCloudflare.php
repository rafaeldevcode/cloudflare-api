<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiCloudflare{

    public function getZones($conta, $page)
    {
        $response = Http::withHeaders([
            'X-Auth-Key'   => $conta->chave_api,
            'X-Auth-Email' => $conta->email,
            'Content-Type' => 'application/json'
        ])->get("https://api.cloudflare.com/client/v4/zones/?page={$page}");

        return $response;
    }

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
}