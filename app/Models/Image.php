<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    public function product(): BelongsTo {
        return $this->belongsTo(Product::class);
    }
}
