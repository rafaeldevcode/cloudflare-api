<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiCloudflare{

    public function getZones($conta)
    {
        $reponse = Http::withHeaders([
            'X-Auth-Key'   => $conta->chave_api,
            'X-Auth-Email' => $conta->email,
            'Content-Type' => 'application/json'
        ])->get("https://api.cloudflare.com/client/v4/zones/");

        return $reponse;
    }

    public function purgeAll($conta, $id)
    {
        $reponse = Http::withHeaders([
            'X-Auth-Key'   => $conta->chave_api,
            'X-Auth-Email' => $conta->email,
            'Content-Type' => 'application/json'
        ])->post("https://api.cloudflare.com/client/v4/zones/{$id}/purge_cache/", [
            '--data'       => [
                'purge_everything' => true
            ]
        ]);

        return $reponse;
    }





    // public function conectarApi()
    // {
    //     $curl = curl_init();

    //     curl_setopt_array($curl, array(
    //     CURLOPT_URL => 'https://api.cloudflare.com/client/v4/zones/',
    //     CURLOPT_RETURNTRANSFER => true,
    //     CURLOPT_ENCODING => '',
    //     CURLOPT_MAXREDIRS => 10,
    //     CURLOPT_TIMEOUT => 0,
    //     CURLOPT_FOLLOWLOCATION => true,
    //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //     CURLOPT_CUSTOMREQUEST => 'GET',
    //     CURLOPT_HTTPHEADER => array(
    //         'X-Auth-Key: 5f71fcec7e31e269d322b091486014e471d9f',
    //         'X-Auth-Email: rafaelv@femglobalbrands.com.br',
    //     ),
    //     ));

    //     $response = curl_exec($curl);

    //     curl_close($curl);

    //     return $response;
    // }
}