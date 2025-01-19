<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function all()
    {
        return User::where('level', '!=', 'admin')->get();
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