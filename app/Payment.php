<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id', 'image', 'is_confirmed', 'confirmed_by',
    ];
}
