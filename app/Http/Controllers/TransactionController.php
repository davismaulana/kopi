<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Services\CustomerService;
use App\Services\MenuService;
use App\Services\PTService;
use App\Services\TransactionService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;;

class TransactionController extends Controller
{
    protected $transactionService;
    protected $menuService;
    protected $userService;
    protected $customerService;
    protected $PTService;

    public function __construct(
        TransactionService $transactionService,
        MenuService $menuService,
        CustomerService $customerService,
        UserService $userService,
        PTService $PTService
    ) {
        $this->transactionService = $transactionService;
        $this->menuService = $menuService;
        $this->userService = $userService;
        $this->customerService = $customerService;
        $this->PTService = $PTService;
    }
    public function index()
    {
        $transactions = $this->transactionService->getAllTransactions()->sortByDesc('created_at');
        return view('pages.transaction.index', compact('transactions'));
    }

    public function create()
    {
        $menus = $this->menuService->getAllMenus()->sortBy('name');
        return view('pages.transaction.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name' => 'required|string',
            'menus' => 'required|array',
            'menus.*.id' => 'required|exists:menus,id',
            'menus.*.quantity' => 'required|integer|min:1',
            'payment_method' => 'required|string|in:Cash,Credit Card,Online Payment',
            'payment_status' => 'required|string|in:unpaid,paid',
        ]);

        $data['user_id'] = Auth::user()->id;

        $this->transactionService->createTransaction($data, $data['user_id']);

        return redirect()->route('transaction.index')->with('success', 'Transaction deleted successfully.');
    }

    public function edit($id)
    {
        $transaction = $this->transactionService->getTransaction($id);
        $menus = $this->menuService->getAllMenus()->sortBy('name');
        $users = $this->userService->getAllUsers()->sortBy('name');
        return view('pages.transaction.edit', compact('transaction', 'menus', 'users'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'customer_name' => 'required|string',
            'menus' => 'required|array',
            'menus.*.id' => 'required|exists:menus,id',
            'menus.*.quantity' => 'required|integer|min:1',
        ]);

        $this->transactionService->updateTransaction($id, $data);

        return redirect()->route('transaction.index')->with('success', 'Transaction updated successfully.');
    }


    public function destroy($id)
    {
        $this->transactionService->deleteTransaction($id);
        return redirect()->route('transaction.index')->with('success', 'Transaction deleted successfully.');
    }
}
