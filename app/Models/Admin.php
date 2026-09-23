<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $fillable = [
        'name',
        'username',
        'password',
        'email',
        'phone'
    ];
    public $timestamps = false;
}
