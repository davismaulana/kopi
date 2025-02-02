<?php

namespace App\Services;

use App\Repositories\DashboardRepository;
use App\Services\CustomerService;
use App\Services\MenuService;
use App\Services\PaymentService;
use App\Services\TransactionService;
use App\Services\UserService;

class DashboardService
{
    protected $userService;
    protected $customerService;
    protected $menuService;
    protected $transactionService;
    protected $paymentService;
    protected $dashboardRepository;

    public function __construct(
        UserService $userService,
        CustomerService $customerService,
        MenuService $menuService,
        TransactionService $transactionService,
        PaymentService $paymentService,
        DashboardRepository $dashboardRepository
    ) {
        $this->userService = $userService;
        $this->customerService = $customerService;
        $this->menuService = $menuService;
        $this->transactionService = $transactionService;
        $this->paymentService = $paymentService;
        $this->dashboardRepository = $dashboardRepository;
    }

    public function totalCustomer()
    {
        $total = $this->customerService->countData();
        return $total;
    }

    public function totalMenus()
    {
        $total = $this->menuService->countData();
        return $total;
    }

    public function totalTransaction()
    {
        $total = $this->transactionService->countData();
        return $total;
    }

    public function totalPayment()
    {
        $total = $this->paymentService->countData();
        return $total;
    }

    public function totalUser()
    {
        $total = $this->userService->countUser();
        return $total;
    }

    public function topSales()
    {
        $top = $this->dashboardRepository->topSales();
        return $top;
    }

    public function topMenus()
    {
        $top = $this->dashboardRepository->topMenus();
        return $top;
    }
}