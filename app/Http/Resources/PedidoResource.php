<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PedidoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $pedido = [
            'pedido_info' =>  [
                'pedido_id' => $this->PEDIDO_ID,
                'endereco_info' => [
                    'endereco_id' => $this->Endereco->ENDERECO_ID,
                    'endereco_nome' => $this->Endereco->ENDERECO_NOME,
                    'endereco_numero' => $this->Endereco->ENDERECO_NUMERO,
                    'endereco_cep' => $this->Endereco->ENDERECO_CEP
                ],
                'status_info' => [
                    'status_id' => $this->Status->STATUS_ID,
                    'status_desc' => $this->Status->STATUS_DESC
                ],
                'pedido_data' => $this->PEDIDO_DATA
            ],
            'pedido_itens' => $this->Itens->map(function ($pedido) {
                return [
                    'produto_id' => $pedido->Produto->PRODUTO_ID,
                    'produto_img' => $pedido->Produto->ProdutoImagem->first() ? $pedido->Produto->ProdutoImagem->first()->IMAGEM_URL : null,
                    'produto_nome' => $pedido->Produto->PRODUTO_NOME,
                    'produto_preco_total' => $pedido->ITEM_PRECO,
                    'produto_qtd' => $pedido->ITEM_QTD

                ];
            })
        ];

        return $pedido;
    }
}
