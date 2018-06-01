<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS_UNPAID = 'UNPAID';
    const STATUS_PAID = 'PAID';
    const STATUS_CANCELLED = 'CANCELLED';

    protected $fillable = [
        'schedule_id', 'user_id', 'qty', 'price', 'total', 'valid_until', 'status',
    ];

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatus()
    {
        return ucfirst(strtolower($this->status));
    }
}
