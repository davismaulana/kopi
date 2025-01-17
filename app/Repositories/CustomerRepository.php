<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function all()
    {
        return Customer::all();
    }

    public function find($id)
    {
        return Customer::findOrFail($id);
    }

    public function create(array $data)
    {
        return Customer::create($data);
    }

    public function update($id, array $data)
    {
        $category = Customer::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        $category = Customer::findOrFail($id);
        $category->delete();
    }

    public function count()
    {
        $count = Customer::count();
        return $count;
    }
}