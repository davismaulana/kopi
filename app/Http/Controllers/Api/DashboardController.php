<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Services\DashboardService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $dashboardService;
    
    public function __construct(
        DashboardService $dashboardService
    ) {
        $this->dashboardService = $dashboardService;
    }

    public function index()
    {
        $totalCustomers = $this->dashboardService->totalCustomer();
        $totalMenus = $this->dashboardService->totalMenus();
        $totalTransactions = $this->dashboardService->totalTransaction();
        $totalPayments = $this->dashboardService->totalPayment();
        $totalUsers = $this->dashboardService->totalUser();
       
        $topMenus = $this->dashboardService->topMenus();
        $paymentDates = $this->dashboardService->loanDates();

        $paymentCounts = $this->dashboardService->countGraph();
        

        return response()->json([
            'totalCustomers' => $totalCustomers,
            'totalMenus' => $totalMenus,
            'totalTransactions' => $totalTransactions,
            'totalPayments' => $totalPayments,
            'totalUsers' => $totalUsers,
            'salesLabels' => $paymentDates,
            'topMenus' => $topMenus,
            'paymentCounts' => $paymentCounts
        ],200);
    }
}
