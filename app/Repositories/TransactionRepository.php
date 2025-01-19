<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\Menu;
use App\Models\Transaction;
use App\Services\MenuService;

class TransactionRepository implements TransactionRepositoryInterface
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
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
        $totalPrice = 0;

        // Create or find customer
        $customer = Customer::firstOrCreate(
            ['name' => $data['customer_name']],
            ['address' => 'Cafe Place Address']
        );

        foreach ($data['menus'] as $menuData) {
            $menu = $this->menuService->getMenu($menuData['id']);
            $totalPrice += $menu->price * $menuData['quantity'];

            // Create the transaction for each menu item
            Transaction::create([
                'user_id' => $cashierId,
                'customer_id' => $customer->id,
                'menu_id' => $menu->id,
                'count' => $menuData['quantity'],
                'total_price' => $menu->price * $menuData['quantity'],
            ]);
        }

        return $totalPrice;
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
