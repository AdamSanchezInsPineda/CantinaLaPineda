<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $casts = [
        'images' => 'array',
    ];    
    protected $fillable = ['category_id', 'code', 'name', 'description', 'price', 'featured', 'images'];
    //
    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }
    public function images(): HasMany {
        return $this->hasMany(Image::class);
    }
    public function orders(): BelongsToMany {
        return $this->belongsToMany(Order::class, 'order_products')->withPivot('quantity');
    }
    public function category_parameters(): BelongsToMany {
        return $this->belongsToMany(CategoryParameter::class, 'product_parameters')->withPivot('value');
    }
}
