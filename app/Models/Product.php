<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $casts = [
        'active' => 'boolean'
    ];

    protected $fillable = [
        'name',
        'descritpion',
        'price',
        'photo',
        'active'
    ];
}
