<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriaVida extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'resumo',
        'conteudo',
        'imagem',
        'nome_pessoa',
        'autor_id',
        'status'
    ];

    public function autor()
    {
        return $this->belongsTo(User::class, 'autor_id');
    }

    public function comentarios()
    {
        return $this->morphMany(Comentario::class, 'commentable');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'historia_tag');
    }

    public function favoritos()
    {
        return $this->morphMany(Favorito::class, 'favoritable');
    }
}