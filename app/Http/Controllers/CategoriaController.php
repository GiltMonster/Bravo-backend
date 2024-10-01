<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        return view('categoria.index', [
            'categorias' => Categoria::all()
        ]);
    }

    public function show(Categoria $categoria)
    {
        return view('categoria.show', [
            'categoria' => $categoria
        ]);
    }
}
