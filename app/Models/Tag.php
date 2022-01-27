<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $fillable = ['nome', 'ids_dominios'];

    public function cloudflare()
    {
        return $this->belongsTo(Cloudflare::class);
    }
}
