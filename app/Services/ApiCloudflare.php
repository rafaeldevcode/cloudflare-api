<?php

namespace App\Services;

use App\Models\Cloudflare;
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
    public function purgeAll($conta, $id):bool
    {
        $response = Http::withHeaders([
            'X-Auth-Key'   => $conta->chave_api,
            'X-Auth-Email' => $conta->email,
            'Content-Type' => 'application/json'
        ])->post("https://api.cloudflare.com/client/v4/zones/{$id}/purge_cache/", [
            'purge_everything' => true
        ]);

        $response = json_decode($response, true);
        
        return $response['success'];
    }

    //////////// LIMPAR VARIOS ARQUIVOS SELECIONADOS /////////////////////
    public function purgePorUrl($conta, $id, $urls):bool
    {
        $response = Http::withHeaders([
            'X-Auth-Key'   => $conta->chave_api,
            'X-Auth-Email' => $conta->email,
            'Content-Type' => 'application/json'
        ])->post("https://api.cloudflare.com/client/v4/zones/{$id}/purge_cache/", [
            'files' => $urls
        ]);

        $response = json_decode($response, true);

        return $response['success'];
    }


    //////// LIMPAR CACHE POR URLS SELECIONADAS ////////////
    public function purgeUrlsSelecionadas($conta, $urls):array
    {
        $responses = [];
        $mensagens = [];

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

        for ($i = 0; $i < count($responses) ; $i++) { 
            $errors = empty($responses[$i]['errors']) ? '' : $responses[$i]['errors'][0]['message'];
            $status = $responses[$i]['success'] == 1 ? 'verdadeiro' : 'falso';
            array_push($mensagens, "ID [{$urls[$i]}] - Staus [{$status}] - Erros [{$errors}]");
        }

        return $mensagens;
    }

     /////////// LIMPAR DOMINIO POR PARAMETRO ////////////
    public function limparDominioPorParametro($conta, $request, $dominio):string
    {
        $clear_dominio = [];
        $response = $this->getAllDominios($conta);

        if(!empty($dominio)){
            foreach($response as $indice => $item){
                if($indice == $dominio){
                    array_push($clear_dominio, $item);
                }
            }
    
            $response = $this->purgeAll($conta, implode('', $clear_dominio));
        }
        
        $mensagem = $response == true ? "Cache do domínio '{$dominio}' limpado com sucesso!" : "Erro ao limpar o cache do dominío '{$dominio}'!";

        return $mensagem;
    }

    //////////// PEGAR TODOS OS DOMINIOS //////////////
    public function getAllDominios($conta):array
    {
        $total_pages = $this->retornarTotalPaginas($conta);
        $responses = [];

        for ($i = 1; $i  <= $total_pages; $i++) { 
            $response = Http::withHeaders([
                'X-Auth-Key'   => $conta->chave_api,
                'X-Auth-Email' => $conta->email,
                'Content-Type' => 'application/json'
            ])->get("https://api.cloudflare.com/client/v4/zones/?page={$i}")['result'];
            array_push($responses, $response);
        }

        $resultados = $this->recuperarDominios($responses);

        return $resultados;
    }

    /////////// RETORNAR PESQUISA POR DOMINIOS ////////
    public function retornarPesquisaPorDominio($conta, $request): array
    {
        $dominios = $this->getAllDominios($conta);
        $dominio = [];

        foreach($dominios as $value => $key){
            if($value === $request->pesquisar){
                array_push($dominio, $value);
                array_push($dominio, $key);
            }
        }

        $response = [
            'result' => [
                0 => [
                    'name' => $dominio[0],
                    'id' => $dominio[1],
                ],
            ],
            'result_info' => [
                'page' => 1,
                'total_pages' => 1,
            ],
        ];

        return $response;
    }

    ///////// RETORNAR QUANTAS PAGINAS TEM A REQUISIÇÃO //////////
    private function retornarTotalPaginas($conta):int
    {
        $total_pages = Http::withHeaders([
            'X-Auth-Key'   => $conta->chave_api,
            'X-Auth-Email' => $conta->email,
            'Content-Type' => 'application/json'
        ])->get("https://api.cloudflare.com/client/v4/zones/")['result_info']['total_pages'];

        return $total_pages;
    }

    /////////// RECUPERARR OS NOMES DOS DOMÍNIOS ///////////////////
    private function recuperarDominios(array $responses):array
    {
        $dominios = [];
        $ids_dominio = [];

        foreach ($responses as $response) {
            for($i = 0; $i < count($response) ; $i++ ) { 
                array_push($dominios, $response[$i]['name']);
                array_push($ids_dominio, $response[$i]['id']);
            }
        }

        $resultados = array_combine($dominios, $ids_dominio);

        return $resultados;
    }
}