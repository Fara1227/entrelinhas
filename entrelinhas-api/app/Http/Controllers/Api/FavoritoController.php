<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorito;
use Illuminate\Http\Request;

class FavoritoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'favoritable_id'=>'required',
            'favoritable_type'=>'required'
        ]);

        $favorito = Favorito::firstOrCreate([
            'user_id'=>auth()->id(),
            'favoritable_id'=>$request->favoritable_id,
            'favoritable_type'=>$request->favoritable_type
        ]);

        return response()->json($favorito,201);
    }

    public function destroy(Favorito $favorito)
    {
        if($favorito->user_id != auth()->id()){
            return response()->json(['error'=>'Não autorizado'],403);
        }

        $favorito->delete();
        return response()->json(['message'=>'Removido dos favoritos']);
    }
}