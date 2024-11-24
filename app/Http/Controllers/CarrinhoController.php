<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarrinhoResource;
use App\Http\Resources\UsuarioResource;
use App\Models\Carrinho;
use App\Models\Produto;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class CarrinhoController extends Controller
{

    public function show($usuario_id)
    {

        if (!$usuario_id) {
            return response()->json(['message' => 'Usuário não informado'], 404);
        }

        $carrinho = CarrinhoResource::collection(Carrinho::where('USUARIO_ID', $usuario_id)->get());

        if ($carrinho->isEmpty()) {
            return response()->json(['message' => 'Carrinho vazio'], 404);
        }

        return response()->json($carrinho, 200);
    }

    public function store(Request $request)
    {
        if (!$request->usuario_id) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        if (Usuario::find($request->usuario_id) == null) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        if (!$request->produto_id) {
            return response()->json(['message' => 'Produto não informado'], 404);
        }

        if (Produto::find($request->produto_id) == null) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        if (!$request->item_qtd) {
            return response()->json(['message' => 'Quantidade não encontrada'], 404);
        }


        if (Carrinho::where('USUARIO_ID', $request->usuario_id)->where('PRODUTO_ID', $request->produto_id)->exists()) {
            $carrinho = Carrinho::where('USUARIO_ID', $request->usuario_id)
                ->where('PRODUTO_ID', $request->produto_id)
                ->first();


            if (Produto::find($request->produto_id)->ProdutoEstoque->PRODUTO_QTD < $carrinho->ITEM_QTD + $request->item_qtd) {
                return response()->json(['message' => 'Quantidade MAXIMA atingida'], 404);
            }

            $carrinho->ITEM_QTD = $carrinho->ITEM_QTD + $request->item_qtd;
            $carrinho->save();

            return response()->json(['message' => 'Produto adicionado ao carrinho com sucesso'], 200);
        }

        $carrinho = new Carrinho();
        $carrinho->USUARIO_ID = $request->usuario_id;
        $carrinho->PRODUTO_ID = $request->produto_id;
        $carrinho->ITEM_QTD = $request->item_qtd;

        $carrinho->save();

        $produto = Produto::find($request->produto_id);

        return response()->json(['message' => 'Carrinho criado com sucesso, aproveite o seu ' . $produto->PRODUTO_NOME], 200);
    }

    public function update(Request $request)
    {

        if (!$request->usuario_id) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }
        if (!$request->produto_id) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }
        if (!$request->item_qtd) {
            return response()->json(['message' => 'Quantidade não declarada'], 404);
        }

        if (Produto::find($request->produto_id)->ProdutoEstoque->PRODUTO_QTD < $request->item_qtd) {
            return response()->json(['message' => 'Quantidade MAXIMA atingida'], 404);
        }

        $carrinho = Carrinho::where('USUARIO_ID', $request->usuario_id)->where('PRODUTO_ID', $request->produto_id)->first();
        $carrinho->ITEM_QTD = $request->item_qtd;
        $carrinho->save();

        return response()->json(['message' => 'Carrinho atualizado com sucesso'], 200);
    }


    public function destroy(Request $request, $produto_id)
    {

        $usuario_id = $request->header('Authorization');

        if (!$usuario_id) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        $user = UsuarioResource::make($user);

        if (!$produto_id) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        if (!Carrinho::where('USUARIO_ID', $user->USUARIO_ID)->where('PRODUTO_ID', $produto_id)->exists()) {
            return response()->json(['message' => 'Produto não encontrado no carrinho'], 404);
        }

        $carrinho = Carrinho::where('USUARIO_ID', $user->USUARIO_ID)->where('PRODUTO_ID', $produto_id)->first();
        $carrinho->delete();

        return response()->json(['message' => 'Produto removido do carrinho com sucesso'], 200);
    }
}
