<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentRequest extends Model
{
    protected $fillable = [
        'store_id',
        'proof_path',
        'status',
        'subscription_method_id'
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
