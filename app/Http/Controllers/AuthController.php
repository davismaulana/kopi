<?php

namespace App\Http\Controllers;

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

    // public function register(RegisterRequest $request)
    // {
    //     $this->authService->register($request);

    //     return response()->json(['message' => 'User registered successfully'], 201);
    // }

    // public function logout(Request $request)
    // {
    //     try {
    //         $repsonse = $this->authService->logout($request);
    //         if (!$repsonse) {
    //             throw new AuthenticationException('Logout failed');
    //         }
    //         // return response()->redirectTo('/');
    //         return response()->json(['message' => 'Logout success'], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['message' => $e->getMessage()], 401);
    //     }
    // }

    public function create()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        // $token = $this->authService->login($request);
        $credentials = $request->only('email','password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json(['redirect' => route('dashboard')]);
        }
        
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect'],
        ]);
    }
}
