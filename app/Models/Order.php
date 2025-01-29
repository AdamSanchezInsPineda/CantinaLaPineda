<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
    public function products(): BelongsToMany {
        return $this->belongsToMany(Product::class, 'order_products');
    }
}
