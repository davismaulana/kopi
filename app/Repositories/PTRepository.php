<?php

namespace App\Repositories;

use App\Models\PaymentTransaction;
use App\Repositories\Contracts\PTRepositoryInterface;

class PTRepository implements PTRepositoryInterface
{
    public function delete($id)
    {
        return PaymentTransaction::where('payment_id', $id)->delete();
    }
}