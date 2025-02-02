<?php

namespace App\Repositories\Contracts;

interface TransactionRepositoryInterface
{
    public function all();
    public function find($id);
    public function create(array $data, $cashierId);
    // public function update();
    public function delete($id);
    public function count();
}