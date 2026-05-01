<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'price', 'stock', 'image', 'description',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'boolean',
    ];
}
