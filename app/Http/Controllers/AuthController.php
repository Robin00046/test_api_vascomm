<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            $token = $user->createToken('token-name')->plainTextToken;
            return response()->json([
                'code' => '200',
                'status' => 'success',
                'data' => [
                    'user' => $user,
                    'token' => $token
                ]
            ], 200);
        }
        return response()->json([
            'code' => '401',
            'status' => 'error',
            'message' => 'Unauthorized'
        ], 401);
    }
    function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'code' => '200',
            'status' => 'success',
            'message' => 'Token Revoked'
        ], 200);
    }
}
