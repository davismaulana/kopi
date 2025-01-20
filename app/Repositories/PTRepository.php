<?php

namespace App\Repositories;

use App\Models\PaymentTransaction;

class PTRepository implements PTRepositoryInterface
{
    public function delete($id)
    {
        return PaymentTransaction::where('transaction_id', $id)->delete();
    }
}