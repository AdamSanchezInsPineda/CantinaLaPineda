<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function products(): HasMany {
        return $this->hasMany(Product::class);
    }
    public function category_parameters(): HasMany {
        return $this->hasMany(CategoryParameter::class);
    }

    protected static function booted()
    {
        static::saving(function ($category) {
            if (!$category->slug) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

}
