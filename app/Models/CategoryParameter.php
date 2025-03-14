<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryParameter extends Model
{
    //
    use HasFactory;
    protected $fillable = ['description', 'category_id'];
    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }
    public function products(): BelongsToMany {
        return $this->belongsToMany(Product::class, 'product_parameters')->withPivot('value');
    }
}