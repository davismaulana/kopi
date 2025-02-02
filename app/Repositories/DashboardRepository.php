<?php

namespace App\Repositories;

use App\Models\Payment;
use App\Repositories\Contracts\DashboardRepositoryInterface;
use Illuminate\Support\Facades\DB;

class DashboardRepository implements DashboardRepositoryInterface
{
    public function topSales()
    {
        $top = Payment::selectRaw('SUM(amount) as total, MONTH(payment_date) as month')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        return $top;
    }

    public function topMenus()
    {
        $top = DB::table('payment_transaction')
        ->join('menus', 'payment_transaction.menu_id', '=', 'menus.id')
        ->selectRaw('menus.name, SUM(payment_transaction.count) as total')
        ->groupBy('menus.name')
        ->orderByDesc('total')
        ->limit(5)
        ->get()
        ->pluck('total', 'name')
        ->toArray();

        return $top;
    }
}
