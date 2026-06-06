<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayoutRequest extends Model
{
    protected $fillable = [
        'store_id',
        'amount',
        'status',
        'bank_details',
        'admin_notes',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
