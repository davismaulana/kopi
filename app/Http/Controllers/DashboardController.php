<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Services\CustomerService;
use App\Services\MenuService;
use App\Services\PaymentService;
use App\Services\TransactionService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        if (Auth::check())
        {
            return view(view: 'dashboard');
        }


        // $totalCustomers = $this->customerService->countData();
        // $totalMenus = $this->menuService->countData();
        // $totalTransactions = $this->transactionService->countData();
        // $totalPayments = $this->paymentService->countData();
        // $totalUsers = $this->userService->countUser();

        // $salesData = Payment::selectRaw('SUM(amount) as total, MONTH(payment_date) as month')
        //     ->groupBy('month')
        //     ->orderBy('month')
        //     ->pluck('total', 'month')
        //     ->toArray();

        // // Top Selling Menus
        // $topMenusData = DB::table('payment_transaction')
        //     ->join('menus', 'payment_transaction.menu_id', '=', 'menus.id')
        //     ->selectRaw('menus.name, SUM(payment_transaction.count) as total')
        //     ->groupBy('menus.name')
        //     ->orderByDesc('total')
        //     ->limit(5)
        //     ->get()
        //     ->pluck('total', 'name')
        //     ->toArray();

        
        // return view('dashboard', compact('totalCustomers', 'totalMenus', 'totalTransactions', 'totalPayments', 'totalUsers','salesData', 'topMenusData'));
    }
}
