<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\CreateTokenRequest;
use App\Http\Requests\Auth\InvalidateTokenRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request) 
    {
        return $this->authService->register($request);
    }

    public function createToken(CreateTokenRequest $request) 
    {
        return $this->authService->createToken($request);
    }

    public function invalidateTokens(InvalidateTokenRequest $request)
    {
        return $this->authService->invalidateTokens($request);
    }
}
