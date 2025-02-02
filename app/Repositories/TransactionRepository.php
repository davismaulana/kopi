<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\Menu;
use App\Models\Payment;
use App\Models\Transaction;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Services\CustomerService;
use App\Services\MenuService;

class TransactionRepository implements TransactionRepositoryInterface
{
    protected $menuService;
    protected $customerService;

    public function __construct(MenuService $menuService, CustomerService $customerService)
    {
        $this->menuService = $menuService;
        $this->customerService = $customerService;
    }

    public function all()
    {
        return Transaction::all();
    }

    public function find($id)
    {
        return Transaction::findOrFail($id);
    }

    public function create(array $data, $cashierId)
    {
        $transactions = [];
        $totalPrice = 0;

        // Create or find customer
        $customer = Customer::firstOrCreate(
            ['name' => $data['customer_name']],
            ['address' => 'Jl. Example Street No. 123']
        );

        foreach ($data['menus'] as $menuData) {
            $menu = $this->menuService->getMenu($menuData['id']);

            // Create the transaction for each menu item
            $transaction =  Transaction::create([
                'user_id' => $cashierId,
                'customer_id' => $customer->id,
                'menu_id' => $menu->id,
                'count' => $menuData['quantity'],
                'total_price' => $menu->price * $menuData['quantity'],
            ]);

            $this->menuService->updateMenuStock($menu->id, $menuData['quantity']);

            $transactions[] = $transaction;
            $totalPrice += $menu->price * $menuData['quantity'];
        }

        // Create a single payment for all transactions
        $payment = Payment::create([
            'customer_name' => $data['customer_name'],
            'payment_method' => $data['payment_method'],
            'amount' => $totalPrice,
            'payment_date' => now(),
            'status' => $data['payment_status'],
        ]);

        // Attach the payment to all transactions
        foreach ($transactions as $transaction) {
            $payment->transactions()->attach($transaction->id, ['menu_id' => $transaction->menu_id, 'count' => $transaction->count]);
        }

        return $transactions;
    }

    public function getMenuById($menuId)
    {
        return Menu::findOrFail($menuId);
    }

    public function getCustomerIdByName($customerName)
    {
        $customer = Customer::where('name', $customerName)->first();
        if (!$customer) {
            // Optionally create a new customer if it doesn't exist
            $customer = Customer::create(['name' => $customerName]);
        }

        return $customer->id;
    }

    public function updateTransaction($transactionId, array $data)
    {
        $transaction = Transaction::findOrFail($transactionId);
        $transaction->update($data);
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
