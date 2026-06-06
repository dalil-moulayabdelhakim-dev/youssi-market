<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $fillable = [
        'store_id',
        'order_id',
        'amount',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
