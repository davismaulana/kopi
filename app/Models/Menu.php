<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = [
        'name',
        'price',
        'stock',
        'image',
        'category',
    ];

    public function scopeFood($query)
    {
        return $query->where('category', 'food');
    }

    public function scopeDrink($query)
    {
        return $query->where('category', 'drink');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'menu_id');
    }

    // Relationship to Payment (through Transaction)
    public function payments()
    {
        return $this->belongsToMany(Payment::class, 'payment_transaction', 'menu_id', 'payment_id')
                    ->withPivot('transaction_id', 'count'); // Include transaction_id in the pivot table
    }
}
