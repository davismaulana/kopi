<?php

namespace App\Repositories;

use App\Models\Transaction;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function all()
    {
        return Transaction::all();
    }

    public function find($id)
    {
        return Transaction::findOrFail($id);
    }

    public function create(array $data)
    {
        return Transaction::create($data);
    }

    public function update($id, array $data)
    {
        $category = Transaction::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        $category = Transaction::findOrFail($id);
        $category->delete();
    }

    public function count()
    {
        $count = Transaction::count();
        return $count;
    }
}