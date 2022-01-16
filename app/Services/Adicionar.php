<?php

    namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Adicionar{
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
    }