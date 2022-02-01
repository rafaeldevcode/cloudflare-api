<?php
    
    namespace App\Services;

use App\Models\Cloudflare;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\DB;

    class Remover{


        ////// REMOVER CONTA ///////
        public function removerConta(int $ID)
        {
            DB::beginTransaction();
                $usuario = User::find($ID);
                $usuario->cloudflare()->each(function(Cloudflare $cloudflare){
                    $cloudflare->tags()->each(function(Tag $tags){
                        $tags->delete();
                    });
                    $cloudflare->delete();
                });
                $usuario->delete();
            DB::commit();
        }

        ///// REMOVER TAG ///////
        public function removerTag($ID)
        {
            DB::beginTransaction();
                Tag::find($ID)->delete();
            DB::commit();
        }
    }