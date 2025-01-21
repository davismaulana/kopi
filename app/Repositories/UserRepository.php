<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    public function all()
    {
        $userId = Auth::user()->id;
        return User::where('id', '!=', $userId)->get();
    }

    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update($id, array $data)
    {
        $category = User::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        $category = User::findOrFail($id);
        $category->delete();
    }

    public function count()
    {
        $count = User::count();
        return $count;
    }
}