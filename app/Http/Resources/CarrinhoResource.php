<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarrinhoResource extends JsonResource
{
    public function toArray(Request $request): array
    {

        $produtos = [];

        foreach ($this->Produto as $produto) {
            $produtos = [
                'id_produto' => $produto->PRODUTO_ID,
                'nome' => $produto->PRODUTO_NOME,
                'preco' => $produto->PRODUTO_PRECO,
                'desconto' => $produto->PRODUTO_DESCONTO,
                'quantidade' => $this->ITEM_QTD,
                'imagens' => $produto->ProdutoImagem->map(function ($imagem) {
                    return [
                        'id' => $imagem->IMAGEM_ID,
                        'order' => $imagem->IMAGEM_ORDEM,
                        'url' => $imagem->IMAGEM_URL
                    ];
                })
            ];
        }
        return $produtos;
    }
}
