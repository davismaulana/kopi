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

    public function getAllTransactions()
    {
        return $this->transactionRepository->all();
    }

    public function getTransaction($id)
    {
        return $this->transactionRepository->find($id);
    }

    public function createTransaction(array $data, $cashierId)
    {
        return $this->transactionRepository->create($data, $cashierId);
    }

    public function updateTransaction($id, array $data)
    {
        return $this->transactionRepository->update($id, $data);
    }

    public function deleteTransaction($id)
    {
        return $this->transactionRepository->delete($id);
    }

    public function countData()
    {
        return $this->transactionRepository->count();
    }
}