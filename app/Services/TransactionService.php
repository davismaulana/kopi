<?php

namespace App\Services;

use App\Repositories\TransactionRepository;

class TransactionService
{
    protected $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function getAllCategories()
    {
        return $this->transactionRepository->all();
    }

    public function getCategory($id)
    {
        return $this->transactionRepository->find($id);
    }

    public function createCategory(array $data)
    {
        return $this->transactionRepository->create($data);
    }

    public function updateCategory($id, array $data)
    {
        return $this->transactionRepository->update($id, $data);
    }

    public function deleteCategory($id)
    {
        return $this->transactionRepository->delete($id);
    }

    public function countData()
    {
        return $this->transactionRepository->count();
    }
}