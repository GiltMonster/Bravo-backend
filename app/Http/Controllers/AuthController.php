<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\Providers\JWT;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = Usuario::where('USUARIO_EMAIL', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Senha ou Email incorretos !!!'], 401);
        }

        if (Hash::check($request->password, $user->USUARIO_SENHA)) {

            $token = JWTAuth::fromUser($user);
            return response()->json(['token' => $token, 'message' => 'Login feito com sucesso'], 200);
        } else {
            return response()->json(['message' => 'Senha ou Email incorretos !!!'], 401);
        }
    }

    public function verifyToken(Request $request)
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        return response()->json(compact('user'));


    }
}
