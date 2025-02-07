<?php

namespace App\Repositories;

use App\Models\Payment;
use App\Repositories\Contracts\DashboardRepositoryInterface;
use Illuminate\Support\Facades\DB;

class DashboardRepository implements DashboardRepositoryInterface
{
    public function loanDates()
    {
        $date = Payment::selectRaw('DATE(created_at) as created_date')
                ->groupBy('created_date')
                ->pluck('created_date');

        return $date;
    }

    public function loanCounts()
    {
        $counts = Payment::selectRaw('COUNT(*) as count')
                ->groupByRaw('DATE(created_at)')
                ->pluck('count');

        return $counts;
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
