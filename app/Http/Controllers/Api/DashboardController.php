<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;

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

        $topSales = $this->dashboardService->topSales();
        $topMenus = $this->dashboardService->topMenus();

        
        return response()->json([
            'totalCustomers' => $totalCustomers,
            'totalMenus' => $totalMenus,
            'totalTransactions' => $totalTransactions,
            'totalPayments' => $totalPayments,
            'totalUsers' => $totalUsers,
            'topSales' => $topSales,
            'topMenus' => $topMenus
        ],200);
    }
}
