<?php
namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Exception;

class AuthService {
    public function register($data)
    {
        // Create User
        $user = new User();

        $user->username = $data['username'];
        $user->password = $data['password'];

        $user->save();

        // Generate token
        $token = $user->createToken('token')->plainTextToken;

        return [
            'token' => $token
        ];
    }

    public function createToken($credentials)
    {
        $user = User::query()->where('username', $credentials['username'])->first();
        
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw new Exception('Invalid user data', 401);
        }

        $token = $user->createToken('token')->plainTextToken;

        return [
            'token' => $token
        ];
    }

    public function invalidateTokens($credentials)
    {        
        $user = User::query()->where('username', $credentials['username'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw new Exception('Invalid user data', 401);
        }

        $user->tokens()->delete();

        return [
            'message' => 'All tokens has delete'
        ];
    }
}