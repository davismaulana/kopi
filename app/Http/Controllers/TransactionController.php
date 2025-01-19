<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Services\CustomerService;
use App\Services\MenuService;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;;

class TransactionController extends Controller
{
    protected $transactionService;
    protected $menuService;

    public function __construct(
        TransactionService $transactionService,
        MenuService $menuService
    ) {
        $this->transactionService = $transactionService;
        $this->menuService = $menuService;
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
        ]);

        $data['user_id'] = Auth::user()->id;

        $this->transactionService->createTransaction($data, $data['user_id']);

        return redirect()->back()->with('success', 'Transaction created successfully.');
    }
}
