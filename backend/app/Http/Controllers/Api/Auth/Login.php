<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(
                ['message' => 'Invalid authentication, check your credentials'], 
                JsonResponse::HTTP_UNAUTHORIZED
            );
        }

        $token = $this->retrieveToken($request->user());

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);        
    }

    private function retrieveToken(User $user): string
    {
        $personalAccess = $user->tokens()->where('name', 'auth_token')->first();

        return !empty($personalAccess)
            ? $personalAccess->token
            : $user->createToken('auth_token')->plainTextToken;
    }
}