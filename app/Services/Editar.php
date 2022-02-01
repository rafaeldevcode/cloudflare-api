<?php

    namespace App\Services;

    use App\Models\{Tag, User};
    use Illuminate\Support\Facades\{Auth, Hash, DB};

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

        ///////// EDITAR TAG //////////
        public function editarTag($ID, $request)
        {
            DB::beginTransaction();
                $tag = Tag::find($ID);
                $tag-> nome = $request->nome;
                $tag->save();
            DB::commit();
        }
    }