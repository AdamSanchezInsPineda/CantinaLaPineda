<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }
    public function images(): HasMany {
        return $this->hasMany(Image::class);
    }
    public function orders(): BelongsToMany {
        return $this->belongsToMany(Order::class, 'order_products');
    }
}
