<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProdutoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $produto = [
            'id' => $this->PRODUTO_ID,
            'nome' => $this->PRODUTO_NOME,
            'descricao' => $this->PRODUTO_DESC,
            'preco' => $this->PRODUTO_PRECO,
            'desconto' => $this->PRODUTO_DESCONTO,
            'estoque' => $this->ProdutoEstoque->PRODUTO_QTD,
            'indisponivel' => $this->ProdutoEstoque->PRODUTO_QTD == 0 ? true : false,
            'imagens' => $this->ProdutoImagem->map(function ($imagem) {
                return [
                    'id' => $imagem->IMAGEM_ID,
                    'order' => $imagem->IMAGEM_ORDEM,
                    'url' => $imagem->IMAGEM_URL
                ];
            })
        ];

        return $produto;
    }
}
