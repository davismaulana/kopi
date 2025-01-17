<?php

namespace App\Repositories;

use App\Models\Food;

class FoodRepository implements FoodRepositoryInterface
{
    public function all()
    {
        return Food::all();
    }

    public function find($id)
    {
        return Food::findOrFail($id);
    }

    public function create(array $data)
    {
        return Food::create($data);
    }

    public function update($id, array $data)
    {
        $category = Food::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        $category = Food::findOrFail($id);
        $category->delete();
    }

    public function count()
    {
        $count = Food::count();
        return $count;
    }
}