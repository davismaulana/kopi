<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{

    protected $table = 'drink';
    protected $fillable = [
        'name',
        'price',
        'stock'
    ];
}
