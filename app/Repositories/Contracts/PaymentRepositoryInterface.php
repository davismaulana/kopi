<?php

namespace App\Repositories\Contracts;

interface PaymentRepositoryInterface
{
    public function all();
    public function find($id);
    public function findMenu($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function count();

}