<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relações

    public function noticias()
    {
        return $this->hasMany(Noticia::class, 'autor_id');
    }

    public function historias()
    {
        return $this->hasMany(HistoriaVida::class, 'autor_id');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function favoritos()
    {
        return $this->hasMany(Favorito::class);
    }

    // Métodos JWT
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}