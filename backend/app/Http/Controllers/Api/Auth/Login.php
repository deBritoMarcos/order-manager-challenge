<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    public function __invoke(LoginRequest $request): JsonResponse
    {
        $credentials = $request->validated();

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json([], JsonResponse::HTTP_OK);
        }

        return response()->json(
            ['message' => 'Invalid authentication, check your credentials'], 
            JsonResponse::HTTP_UNAUTHORIZED
        );
    }
}