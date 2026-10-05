<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $fillable = [
        'product_name',
        'category_id',
        'price',
        'description',
        'image',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public $timestamps = false;
}
