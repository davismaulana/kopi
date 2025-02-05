<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\HasApiTokens;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    // public function register(RegisterRequest $request)
    // {
    //     $this->authService->register($request);

    //     return response()->json([
    //        'message' => 'Register successfull',
    //     ],201);
    // }

    public function register(RegisterRequest $request)
    {
        $this->authService->register($request);

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    public function login(LoginRequest $request)
    {
        try {
            $response = $this->authService->login($request);

            if (!$response['status']) {
                return response()->json($response,401);
            }
            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'An unexpected error occured']);
        }
    }

    public function logout(Request $request)
    {
        try {
            $repsonse = $this->authService->logout($request);
            if (!$repsonse) {
                throw new AuthenticationException('Logout failed');
            }
            // return response()->redirectTo('/');
            return response()->json(['message' => 'Logout success'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }
}
