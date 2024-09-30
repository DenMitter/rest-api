<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\CreateTokenRequest;
use App\Http\Requests\Auth\InvalidateTokenRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function register(RegisterRequest $request) 
    {
        $data = $request->validated();

        // Create User
        $user = new User();

        $user->username = $data['username'];
        $user->password = $data['password'];

        $user->save();

        // Generate token
        $token = $user->createToken('token')->plainTextToken;

        $user->tokens()->delete();

        return response()->json([
            'success' => true,
            'data' => [
                'token' => $token,
            ]
        ]);
    }

    public function createToken(CreateTokenRequest $request) 
    {
        $credentials = $request->only('username', 'password');

        $user = User::query()->where('username', $credentials['username'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'success' => false,
                'messsage' => 'Invalid user data'
            ], 401);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
            'success' => true,
            'data' => [
                'token' => $token
            ]
        ]);
    }

    public function invalidateTokens(InvalidateTokenRequest $request)
    {
        $credentials = $request->only('username', 'password');
        
        $user = User::query()->where('username', $credentials['username'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'success' => false,
                'messsage' => 'Invalid user data'
            ], 401);
        }

        $user->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'All tokens has delete'
        ]);
    }
}
