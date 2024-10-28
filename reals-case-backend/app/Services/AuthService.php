<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class AuthService 
{
    public function register(array $data)
    {
        $user = User::create($data);

        $token = $user->createToken($data['name']);

        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }

    public function login(array $data)
    {
        $user = User::where('email', $data['email'])->first();
        
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return [
                'errors' => [
                    'email' => ['As credenciais fornecidas estão incorretas.']
                ]
            ];
        }
        
        if (!$user->active) {
            return [
                'errors' => [
                    'email' => ['Usuário não está ativo.']
                ]
            ];
        }
        
        $token = $user->createToken($user->name);

        return [
            'user' => $user,
            'token' => $token->plainTextToken
        ];
    }

}