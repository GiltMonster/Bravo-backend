<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnderecoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $endereco = [
            'id' => $this->ENDERECO_ID,
            'nome' => $this->ENDERECO_NOME,
            'cep' => $this->ENDERECO_CEP,
            'cidade' => $this->ENDERECO_CIDADE,
            'estado' => $this->ENDERECO_ESTADO,
            'numero' => $this->ENDERECO_NUMERO,
            'logradouro' => $this->ENDERECO_LOGRADOURO,
            'complemento' => $this->ENDERECO_COMPLEMENTO
        ];

        return $endereco;
    }
}
