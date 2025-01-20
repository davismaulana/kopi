<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use App\Services\MenuService;
use App\Services\PaymentService;
use App\Services\TransactionService;
use App\Services\UserService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $userService;
    protected $customerService;
    protected $menuService;
    protected $transactionService;
    protected $paymentService;

    public function __construct(
        UserService $userService,
        CustomerService $customerService,
        MenuService $menuService,
        TransactionService $transactionService,
        PaymentService $paymentService
    ) {
        $this->userService = $userService;
        $this->customerService = $customerService;
        $this->menuService = $menuService;
        $this->transactionService = $transactionService;
        $this->paymentService = $paymentService;
    }

    public function index()
    {
        $totalCustomers = $this->customerService->countData();
        $totalMenus = $this->menuService->countData();
        $totalTransactions = $this->transactionService->countData();
        $totalPayments = $this->paymentService->countData();
        $totalUsers = $this->userService->countData();
        return view('dashboard', compact('totalCustomers', 'totalMenus', 'totalTransactions', 'totalPayments', 'totalUsers'));
    }
}

