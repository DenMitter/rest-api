<?php
namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthService {
    public function register($request)
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

    public function createToken($request)
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

    public function invalidateTokens($request)
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