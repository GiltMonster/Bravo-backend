<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriaResource;
use App\Http\Resources\ProdutoResource;
use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $categorias = CategoriaResource::collection(Categoria::where('CATEGORIA_ATIVO', 1)
            ->whereHas('Produtos')
            ->get())
            ->toJson();

        return $categorias;
    }

    public function show(Produto $produto)
    {
        $produto = ProdutoResource::make($produto)
            ->toJson();

        return $produto;
    }
}
