<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $fillable = [
        'category_name'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public $timestamps = false;
}
