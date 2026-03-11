<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Noticia;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    public function index()
    {
        return response()->json(Noticia::with(['categoria','autor','tags','comentarios'])->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'=>'required|string',
            'conteudo'=>'required|string',
            'categoria_id'=>'required|exists:categorias,id',
            'tags'=>'array'
        ]);

        $noticia = Noticia::create([
            'titulo'=>$request->titulo,
            'subtitulo'=>$request->subtitulo,
            'conteudo'=>$request->conteudo,
            'categoria_id'=>$request->categoria_id,
            'autor_id'=>auth()->id(),
            'destaque'=>$request->destaque ?? false
        ]);

        if($request->tags){
            $noticia->tags()->sync($request->tags);
        }

        return response()->json($noticia->load('tags','categoria','autor'),201);
    }

    public function show(Noticia $noticia)
    {
        return response()->json($noticia->load(['categoria','autor','tags','comentarios']));
    }

    public function update(Request $request, Noticia $noticia)
    {
        $noticia->update($request->only(['titulo','subtitulo','conteudo','categoria_id','destaque']));

        if($request->tags){
            $noticia->tags()->sync($request->tags);
        }

        return response()->json($noticia->load('tags','categoria','autor'));
    }

    public function destroy(Noticia $noticia)
    {
        $noticia->delete();
        return response()->json(['message'=>'Notícia removida']);
    }
}