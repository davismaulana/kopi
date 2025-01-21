<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'customer_name',
        'ordered_menu',
        'payment_method',
        'amount',
        'payment_date',
        'status'
    ];

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'payment_transaction')
                    ->withPivot('menu_id', 'count'); // Include menu_id in the pivot table
    }

    // Relationship to Menu (through Transaction)
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'payment_transaction', 'payment_id', 'menu_id')
                    ->withPivot('transaction_id', 'count'); // Include transaction_id in the pivot table
    }
}
