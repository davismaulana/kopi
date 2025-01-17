<?php

namespace App\Repositories;

use App\Models\Drink;

class DrinkRepository implements DrinkRepositoryInterface
{
    public function all()
    {
        return Drink::all();
    }

    public function find($id)
    {
        return Drink::findOrFail($id);
    }

    public function create(array $data)
    {
        return Drink::create($data);
    }

    public function update($id, array $data)
    {
        $category = Drink::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        $category = Drink::findOrFail($id);
        $category->delete();
    }

    public function count()
    {
        $count = Drink::count();
        return $count;
    }
}