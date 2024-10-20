<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function store(Request $request)
    {
        $usuario = new Usuario();

        if (Usuario::where('USUARIO_EMAIL', $request->email)->exists()) {
            return response()->json([
                'message' => 'E-mail já cadastrado!',
                'usuario' => null
            ], 400);
        }

        if (Usuario::where('USUARIO_CPF', $request->cpf)->exists()) {
            return response()->json([
                'message' => 'CPF já cadastrado!',
                'usuario' => null
            ], 400);
        }

        $usuario->USUARIO_NOME = $request->name;
        $usuario->USUARIO_EMAIL = $request->email;
        $usuario->USUARIO_SENHA = Hash::make($request->password);
        $usuario->USUARIO_CPF = $request->cpf;

        if ($usuario->save()) {
            return response()->json([
                'message' => 'Usuário criado com sucesso!',
                'usuario' => $usuario->USUARIO_NOME
            ], 201);
        } else {
            return response()->json([
                'message' => 'Erro ao criar usuário!',
                'usuario' => null
            ], 400);
        }
    }
}
