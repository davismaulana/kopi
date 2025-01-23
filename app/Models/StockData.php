<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockData extends Model
{
    protected $table = 'stock_data';

    protected $fillable = [
        'transaction_id',
        'stock_in',
        'stock_out',
    ];

    
}
