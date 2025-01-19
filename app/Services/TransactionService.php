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

    public function updateTransaction($transactionId, array $data)
    {
        $menus = $data['menus'];
        $totalPrice = 0;

        // Calculate total price
        foreach ($menus as $menu) {
            $menuDetails = $this->transactionRepository->getMenuById($menu['id']);
            $totalPrice += $menuDetails->price * $menu['quantity'];
        }

        $transactionData = [
            'customer_id' => $this->transactionRepository->getCustomerIdByName($data['customer_name']),
            'menu_id' => $menus[0]['id'], // If a single menu is tied to a transaction
            'count' => $menus[0]['quantity'], // Quantity of the single menu
            'total_price' => $totalPrice,
        ];

        $this->transactionRepository->updateTransaction($transactionId, $transactionData);
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
