<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'conteudo'=>'required|string',
            'commentable_id'=>'required',
            'commentable_type'=>'required'
        ]);

        $comentario = Comentario::create([
            'conteudo'=>$request->conteudo,
            'user_id'=>auth()->id(),
            'commentable_id'=>$request->commentable_id,
            'commentable_type'=>$request->commentable_type
        ]);

        return response()->json($comentario,201);
    }

    public function destroy(Comentario $comentario)
    {
        $comentario->delete();
        return response()->json(['message'=>'Comentário removido']);
    }
}