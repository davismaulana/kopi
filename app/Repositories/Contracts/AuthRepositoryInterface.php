<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Http\Request;

interface AuthRepositoryInterface
{
    public function findByEmail(string $email); 

    public function register($request);
}