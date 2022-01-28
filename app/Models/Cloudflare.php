<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Cloudflare extends Model
{

    protected $table = 'cloudflare';

    protected $fillable = [
        'user_id',
        'nome',
        'email',
        'chave_api'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags(){
        return $this->hasMany(Tag::class);
    }
}
