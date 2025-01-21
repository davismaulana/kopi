<?php

namespace App\Repositories;

interface MenuRepositoryInterface
{
    public function all();
    public function searchAndSort($search, $sortBy, $sortOrder);
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function updateStock($id, $quantity);
    public function delete($id);
    public function count();
}