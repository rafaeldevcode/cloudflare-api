<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdicionarContaCloudflare extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cloudflare', function(Blueprint $table){
            $table->increments('id');
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('nome');
            $table->string('email');
            $table->string('chave_api');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cloudflare');
    }
}
