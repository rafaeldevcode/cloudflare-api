<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Cloudflare;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image_usuario',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cloudflare()
    {
        return $this->hasMany(Cloudflare::class);
    }

    public function getImagemUsuarioAttribute()
    {
        // if($this->image_usuario){
        //     return Storage::url($this->image_usuario);
        // }else{
        //     return str_replace('/storage', '', Storage::url('images/avatar.png'));
        // }

        if($this->image_usuario){
            return 'https://' . str_replace('www.', '', $_SERVER['HTTP_HOST']) . "\/storage\/" . $this->image_usuario;
        }else{
            return 'https://' . str_replace('www.', '', $_SERVER['HTTP_HOST']) . '/images/avatar.png';
        }
    }
}
