<?php

namespace App\Services;

use App\Repositories\Contracts\AuthRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
            $validator = Validator::make($request->all(),
                $request->rules()
            );
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $credentials = $validator->validated();

            $user = $this->authRepository->findByEmail($credentials['email']);

            if (!$user) {
                return [
                    'status' => false,
                    'message' => 'Password is incorrect'
                ];
            } else if (!Hash::check($credentials['password'], $user->password)){
                return [
                    'status' => false,
                    'message' => 'Password incorrect'
                ];
            }

            $token = $user->createToken('auth_token')->plainTextToken;
            session()->regenerate();
            Auth::login($user);

            return ['status' => true, 'message' => 'Login success', 'token' => $token];

        } catch (ValidationException $e) {
            return ['status' => false, 'message' => 'Validation failed', 'errors' => $e->errors()];
        } catch (\Exception $e) {
            return ['status' => false, 'message' => 'An error occurred during login', 'error' => $e->getMessage()];
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