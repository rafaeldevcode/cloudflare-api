<?php

    namespace App\Services;

use App\Models\Cloudflare;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Adicionar{

    //////// ADICIONAR USUÁRIO ///////
    public function adidionarUsuario($request)
    {
        DB::beginTransaction();
            $data = $request->except('_toke');
            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);
        DB::commit();

        if(!Auth::user()){
            Auth::login($user);
        }
    }

    /////////// ADICIONAR AVATAR DO USUÁRIO /////////////
    public function adicionarImagenUsuario($request, $ID)
    {
        DB::beginTransaction();
            $usuario = User::find($ID);
            if(!empty($usuario->image_usuario)){Storage::delete($usuario->image_usuario);}
            $usuario->image_usuario = $request->file('image_usuario')->store('galeria');
            $usuario->save();
        DB::commit();
    }

    /////////// ADICIONAR CONTA CLOUDFLARE //////////
    public function adicionarContaCloudflare($request, $ID)
    {
        DB::beginTransaction();
            $usuario = User::find($ID);
            $usuario->cloudflare()->create($request->all());
        DB::commit();
    }

    ////////////// ADICIONAR TAGS DOS DOMÍNIOS ///////////////////
    public function adicionarTag($request, $ID)
    {
        DB::beginTransaction();
            $conta = Cloudflare::find($ID);
            $data = $request->all();
            $data['ids_dominio'] = implode(',', $request->ids_dominio);
            $conta->tags()->create($data);
        DB::commit();
    }
}