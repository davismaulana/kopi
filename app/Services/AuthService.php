<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\AuthRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login($request)
    {
        try {
            $validator = Validator::make($request->all(), $request->rules());
            $credentials = $validator->validated();
            $email = $credentials['email'];
            $password = $credentials['password'];

            // Find user by email
            $user = $this->authRepository->findUserByEmail($email);

            // Check if user exists and password is correct
            if ($user && Hash::check($password, $user->password)) {
                $token = $user->createToken('auth_token')->plainTextToken;
                session()->regenerate();
                Auth::login($user);

                return [
                    'status' => 200,
                    'message' => 'Log in Successfull!',
                    'data' => [
                        'email' => $user->email,
                        'token' => $token,
                        'user' => $user
                    ]
                ];
            }
            // Return failure message if login fails
            return [
                'status' => 400,
                'message' => 'Email or Password is wrong',
            ];
        } catch (\Exception $e) {
            Log::error('Login failed: ' . $e->getMessage());
            return [
                'status' => 500,
                'message' => 'There is something problem',
                'error' => $e->getMessage(),
            ];
        }    
    }

    public function findByEmail($request)
    {
        return $this->findByEmail($request);
    }

    public function register($request)
    {
        $this->authRepository->register($request);
    }

    public function logout(Request $request): bool
    {
        try {
            if (!$request->hasSession()) {
                $request->setLaravelSession(app('session.store'));
            }
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return true;
        } catch (\Exception $e) {
            throw $e;
        }
    }

}