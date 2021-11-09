<?php

namespace App\Http\Controllers\Api;

use App\Facades\Users;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $validatedData = $request->validated();

        $token = Auth::guard()->attempt($validatedData, true);

        if (!$token) {
            abort(401);
        }

        return $this->respondWithToken($token);
    }

    public function logout(): JsonResponse
    {
        Auth::logout();

        return response()->json('ok');
    }

    /**
     * Returns json response after sucessfully login with generated token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function respondWithToken(string $token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60 // auth()->factory()
        ]);
    }
}
