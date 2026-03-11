<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'slug'];

    public function noticias()
    {
        return $this->belongsToMany(Noticia::class);
    }

    public function historias()
    {
        return $this->belongsToMany(HistoriaVida::class, 'historia_tag');
    }
}