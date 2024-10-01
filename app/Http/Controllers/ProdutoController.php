<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $categorias = Categoria::with("Produtos")
            ->get();

        return $categorias->toJson();
    }

    public function home()
    {
        $produtos = Produto::where('PRODUTO_DESCONTO', '>', 10)->get();

        return view('produto.home', [
            'produtos' => $produtos
        ]);
    }
}
