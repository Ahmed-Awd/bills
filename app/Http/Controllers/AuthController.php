<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $user = User::where('email', $data['email'])->first();

            $jwt = JWTAuth::fromUser($user);

            return response()->json([
                'jwt_token' => $jwt,
                'token_type' => 'Bearer',
                'user' => UserResource::make($user),
            ]);
        }
        return response()->json(['message' => Lang::get('messages.auth.invalid')], 401);
    }

}
