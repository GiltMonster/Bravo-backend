<?php

namespace App\Http\Controllers;

use App\Http\Resources\EnderecoResource;
use App\Models\Endereco;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class EnderecoController extends Controller
{

    public function show($id)
    {
        if(JWTAuth::parseToken()->authenticate()->USUARIO_ID != $id){
            return response()->json(['message' => 'Usuário não autorizado'], 401);
        }

        $enderecos = EnderecoResource::collection(Endereco::where('USUARIO_ID', $id)->get());
        return response()->json($enderecos, 200);
    }

    public function store(Request $request)
    {

        if(JWTAuth::parseToken()->authenticate()->USUARIO_ID != $request->usuario_id){
            return response()->json(['message' => 'Usuário não autorizado'], 401);
        }

        $endereco = new Endereco([
            'USUARIO_ID' => $request->usuario_id,
            'ENDERECO_NOME' => $request->nome,
            'ENDERECO_CEP' => $request->cep,
            'ENDERECO_CIDADE' => $request->cidade,
            'ENDERECO_ESTADO' => $request->estado,
            'ENDERECO_NUMERO' => $request->numero,
            'ENDERECO_LOGRADOURO' => $request->logradouro,
            'ENDERECO_COMPLEMENTO' => $request->complemento
        ]);

        $endereco->save();

        return response()->json(['message' => 'Endereço cadastrado com sucesso'], 201);
    }

    function update(Request $request, Endereco $endereco){
        if(JWTAuth::parseToken()->authenticate()->USUARIO_ID != $endereco->USUARIO_ID){
            return response()->json(['message' => 'Usuário não autorizado'], 401);
        }

        $endereco->update([
            'ENDERECO_NOME' => $request->nome,
            'ENDERECO_CEP' => $request->cep,
            'ENDERECO_CIDADE' => $request->cidade,
            'ENDERECO_ESTADO' => $request->estado,
            'ENDERECO_NUMERO' => $request->numero,
            'ENDERECO_LOGRADOURO' => $request->logradouro,
            'ENDERECO_COMPLEMENTO' => $request->complemento
        ]);
        return response()->json(['message' => 'Endereço atualizado com sucesso'], 200);
    }


    public function destroy($id){
        $endereco = Endereco::find($id);

        if(JWTAuth::parseToken()->authenticate()->USUARIO_ID != $endereco->USUARIO_ID){
            return response()->json(['message' => 'Usuário não autorizado'], 401);
        }

        $endereco->delete();
        return response()->json(['message' => 'Endereço deletado com sucesso'], 200);
    }

}
