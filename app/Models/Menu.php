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
}
