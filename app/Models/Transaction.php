<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $fillable = ['user_id', 'customer_id', 'menu_id', 'count', 'total_price'];

    public function cashier()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function payments()
    {
        return $this->belongsToMany(Payment::class, 'payment_transaction')
                    ->withPivot('menu_id', 'count'); // Include menu_id in the pivot table
    }

    // Relationship to Menu (many-to-one)
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function stockData()
    {
        return $this->belongsTo(StockData::class, 'transaction_id');
    }
}
