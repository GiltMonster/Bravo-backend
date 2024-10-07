<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoriaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $produtos = $this->Produtos;

        if ($produtos) {
            $produtos = $produtos->map(function ($produto) {
                return [
                    'id' => $produto->PRODUTO_ID,
                    'nome' => $produto->PRODUTO_NOME,
                    'descricao' => $produto->PRODUTO_DESC,
                    'preco' => $produto->PRODUTO_PRECO,
                    'desconto' => $produto->PRODUTO_DESCONTO,
                    'estoque' => $produto->ProdutoEstoque->PRODUTO_QTD,
                    'imagens' => $produto->ProdutoImagem->map(function ($imagem) {
                        return [
                            'id' => $imagem->IMAGEM_ID,
                            'order' => $imagem->IMAGEM_ORDEM,
                            'url' => $imagem->IMAGEM_URL
                        ];
                    })
                ];
            });
        }

        $categoria = [
            'id' => $this->CATEGORIA_ID,
            'nome' => $this->CATEGORIA_NOME,
            'descricao' => $this->CATEGORIA_DESC,
            'img' => $this->CATEGORIA_IMAGEM,
            'produtos'=> $produtos
        ];

        return $categoria;
    }
}
