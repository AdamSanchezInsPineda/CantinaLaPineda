<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderProduct extends Model
{
    //
    protected $table = "order_products";
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
    ];
}
