<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;

class Order extends Model
{
    public $fillable = [
        'name',
        'phone',
        'total_price',
        'status'
    ];

    public function items() {
        return $this->hasMany(OrderItem::class);
    }
}
