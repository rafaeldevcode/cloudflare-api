<?php

    namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Editar{

        /////////// EDITAR USUÁRIO ////////////
        public function editarUsuario($request, $usuario)
        {
            DB::beginTransaction();
                if(!empty($request->name)){$usuario->name = $request->name;}
                if(!empty($request->password)){$usuario->password = Hash::make($request->password);}
                $usuario->save();
            DB::commit();
        }
    }