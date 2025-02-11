<?php

namespace App\Repositories;

use App\Models\Payment;
use App\Repositories\Contracts\PaymentRepositoryInterface;

class PaymentRepository implements PaymentRepositoryInterface
{
    public function all()
    {
        return Payment::with(['transactions.menu'])->get();
    }

    public function searchAndSort($search, $sortBy, $sortOrder) {}

    public function find($id)
    {
        return Payment::findOrFail($id);
    }

    public function findMenu($id)
    {
        return Payment::with('menus')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Payment::create($data);
    }

    public function update($id, array $data)
    {
        $payment = Payment::findOrFail($id);
        $payment->update([
            'payment_method' => $data['payment_method'],
            'status' => $data['payment_status'],
        ]);
        return $payment;
    }

    public function delete($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();
    }

    public function count()
    {
        $payment = Payment::count();
        return $payment;
    }

    public function countGraph()
    {
        $payments = Payment::selectRaw('COUNT(*) as count')
            ->groupByRaw('DATE(created_at)')
            ->pluck('count');

        return $payments;
    }
}
