<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserRepositoryInterface
{
    public function all()
     {
    //     $userId = Auth::user()->id;
    //     return User::where('id', '!=', $userId)->get();
        return User::latest()->get();

        // $query = User::query();

        // if (!empty($search)) {
        //     $query->where(function ($q) use ($search) {
        //         $q->where('name', 'LIKE', '%' . $search . '%')
        //             ->orWhere('email', 'LIKE', '%' . $search . '%');
        //     });
        // }

        // return $query->get();

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

    public function countUser()
    {
        $count = User::count();
        return $count;
    }
    public function countAdmin()
    {
        $admin = User::where('level','admin')->count();
        return $admin;
    }
    public function countCashier()
    {
        $cashier = User::where('level','cashier')->count();
        return $cashier;
    }
    public function countCustomer()
    {
        $customer = User::where('level','customer')->count();
        return $customer;
    }
}