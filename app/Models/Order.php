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
        'payment_method',
        'status'
    ];

    public function items() {
        return $this->hasMany(OrderItem::class);
    }
}
