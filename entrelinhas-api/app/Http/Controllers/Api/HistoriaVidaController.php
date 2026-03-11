<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HistoriaVida;
use Illuminate\Http\Request;

class HistoriaVidaController extends Controller
{
    public function index()
    {
        return response()->json(HistoriaVida::with(['autor','tags','comentarios'])->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'=>'required|string',
            'conteudo'=>'required|string',
            'nome_pessoa'=>'required|string',
            'tags'=>'array'
        ]);

        $historia = HistoriaVida::create([
            'titulo'=>$request->titulo,
            'resumo'=>$request->resumo,
            'conteudo'=>$request->conteudo,
            'nome_pessoa'=>$request->nome_pessoa,
            'autor_id'=>auth()->id(),
            'status'=>'pendente'
        ]);

        if($request->tags){
            $historia->tags()->sync($request->tags);
        }

        return response()->json($historia->load('tags','autor'),201);
    }

    public function show(HistoriaVida $historia)
    {
        return response()->json($historia->load(['autor','tags','comentarios']));
    }

    public function update(Request $request, HistoriaVida $historia)
    {
        $historia->update($request->only(['titulo','resumo','conteudo','status']));

        if($request->tags){
            $historia->tags()->sync($request->tags);
        }

        return response()->json($historia->load('tags','autor'));
    }

    public function destroy(HistoriaVida $historia)
    {
        $historia->delete();
        return response()->json(['message'=>'História removida']);
    }
}