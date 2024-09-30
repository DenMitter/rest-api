<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\RegisterRequest;
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
}
