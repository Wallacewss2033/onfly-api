<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(AuthRequest $request)
    {

        $credentials = $request->only('email', 'password');

        if (!auth()->attempt($credentials)) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        return response()->json([
            'message' => 'Logado com sucesso!',
            'data' => [
                'name' => auth()->user()->name,
                'token' => auth()->user()->createToken('auth-token')->plainTextToken,
            ]
        ], 200);
    }

    public function check()
    {
        if (auth()->check()) {
            return response()->json(['success' => true, 'mensagem' => 'Usuário autenticado'], 200);
        } else {
            return response()->json(['success' => true, 'mensagem' => 'Token inválido'], 401);
        }
    }

    public function logout()
    {
        if (auth()->user()->currentAccessToken()->delete()) {
            return response()->json(200);
        }
    }
}
