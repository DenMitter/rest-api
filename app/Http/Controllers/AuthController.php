<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\CreateTokenRequest;
use App\Http\Requests\Auth\InvalidateTokenRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use Exception;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request) 
    {
        try {
            $data = $this->authService->register($request->validated());

            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false
            ], 400);
        }
    }

    public function createToken(CreateTokenRequest $request) 
    {
        try {
            $data = $this->authService->createToken($request->validated());

            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], $exception->getCode());
        }
    }

    public function invalidateTokens(InvalidateTokenRequest $request)
    {
        try {
            $data = $this->authService->invalidateTokens($request->validated());

            return response()->json([
                'success' => true,
                'message' => $data
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], $exception->getCode());
        }
    }
}
