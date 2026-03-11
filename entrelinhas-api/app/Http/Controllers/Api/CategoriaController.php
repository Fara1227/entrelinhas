<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        return response()->json(Categoria::all());
    }

    public function store(Request $request)
    {
        $request->validate(['nome'=>'required|string']);
        $categoria = Categoria::create([
            'nome'=>$request->nome,
            'slug'=>\Str::slug($request->nome)
        ]);
        return response()->json($categoria, 201);
    }

    public function show(Categoria $categoria)
    {
        return response()->json($categoria);
    }

    public function update(Request $request, Categoria $categoria)
    {
        $categoria->update([
            'nome'=>$request->nome,
            'slug'=>\Str::slug($request->nome)
        ]);
        return response()->json($categoria);
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return response()->json(['message'=>'Categoria removida']);
    }
}