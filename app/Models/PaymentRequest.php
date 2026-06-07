<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentRequest extends Model
{
    protected $fillable = [
        'store_id',
        'proof_path',
        'status',
        'transaction_reference',
        'grace_period_ends_at',
        'subscription_method_id'
    ];

    protected $casts = [
        'grace_period_ends_at' => 'datetime',
    ];

    public function store()
    {

        return $this->belongsTo(Store::class, 'store_id');
    }

    public function subscription_method()
    {
        return $this->belongsTo(SubscriptionMethod::class, 'subscription_method_id');
    }
}
