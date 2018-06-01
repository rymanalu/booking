<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'from', 'to', 'date', 'time', 'price', 'is_full', 'capacity', 'available',
    ];

    protected $casts = [
        'is_full' => 'boolean',
    ];

    protected $dates = ['deleted_at', 'date'];

    public function fromOutlet()
    {
        return $this->belongsTo(Outlet::class, 'from');
    }

    public function toOutlet()
    {
        return $this->belongsTo(Outlet::class, 'to');
    }
}
