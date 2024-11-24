<?php

namespace App\Http\Controllers;

use App\Http\Resources\PedidoResource;
use App\Models\Endereco;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Produto;
use App\Models\Usuario;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function show($usuario_id)
    {
        if (!$usuario_id) {
            return response()->json(['message' => 'Usuário não informado'], 404);
        }

        if (Usuario::find($usuario_id) === null) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        $pedido = PedidoResource::collection(Pedido::where('USUARIO_ID', $usuario_id)->get());

        if ($pedido->isEmpty()) {
            return response()->json(['message' => 'Usuário sem nenhum pedido'], 404);
        }

        return response()->json($pedido, 200);
    }

    public function store(Request $request)
    {

        if (Usuario::find($request->usario_id) === null) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        if (Endereco::find($request->endereco_id) === null) {
            return response()->json(['message' => 'Endereço não encontrado'], 404);
        }

        if (!is_array($request->produtos_ids_qtd) || empty($request->produtos_ids_qtd)) {
            return response()->json(['message' => 'Nenhum produto informado ou formato inválido'], 400);
        }

        // Validação de cada produto
        foreach ($request->produtos_ids_qtd as $produto_id => $qtd) {
            $produto = Produto::find($produto_id);

            if ($produto === null) {
                return response()->json(['message' => "Produto com ID $produto_id não encontrado"], 404);
            }

            if (!is_numeric($qtd) || $qtd <= 0) {
                return response()->json(['message' => "Quantidade inválida para o produto ID $produto_id"], 400);
            }

            if ($produto->ProdutoEstoque->PRODUTO_QTD < $qtd) {
                return response()->json(['message' => "Quantidade insuficiente no estoque para o produto ID $produto_id"], 400);
            }

        }

        // Criar o pedido
        $pedido = new Pedido([
            'USUARIO_ID' => $request->usario_id,
            'ENDERECO_ID' => $request->endereco_id,
            'STATUS_ID' => 5,
            'PEDIDO_DATA' => date('Y-m-d H:i:s')
        ]);

        $pedido->save();

        // Criar itens do pedido e atualizar estoque
        foreach ($request->produtos_ids_qtd as $produto_id => $qtd) {
            $produto = Produto::find($produto_id);

            $item_preco = ($produto->PRODUTO_PRECO * $qtd) - ($produto->PRODUTO_DESCONTO * $qtd);

            // Criar o item do pedido
            $pedido_item = new PedidoItem([
                'PEDIDO_ID' => $pedido->PEDIDO_ID,
                'PRODUTO_ID' => $produto_id,
                'ITEM_PRECO' => $item_preco,
                'ITEM_QTD' => $qtd
            ]);

            $pedido_item->save();

            // Atualizar o estoque do produto
            $produto->ProdutoEstoque->PRODUTO_QTD -= $qtd;
            $produto->ProdutoEstoque->save();
        }

        return response()->json(['message' => 'Pedido criado com sucesso'], 201);
    }
}
