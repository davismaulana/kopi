<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';
    protected $fillable =
    [
        'customer_id',
        'food_id',
        'drink_id',
        'food_total',
        'drink_total'
    ];
}
