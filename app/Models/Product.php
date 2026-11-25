<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

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
