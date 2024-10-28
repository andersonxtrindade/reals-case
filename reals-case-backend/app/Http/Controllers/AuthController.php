<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AuthService;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'active' => 'required'
        ]);

        $authService = new AuthService();

        return response()->json($authService->register($request->all()));
    }

    public function login(Request $request): JsonResponse
    {
        $authService = new AuthService();

        return response()->json($authService->login($request->all()));
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'You are logged out.' 
        ]);
    }
}
