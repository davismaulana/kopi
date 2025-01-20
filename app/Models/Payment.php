<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'payment_method',
        'amount',
        'payment_date',
        'status'
    ];

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'payment_transaction');
    }
}
