<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'name',
        'category',
        'address',
        'contact',
        'subscription_method_id',
        'trial_ends_at',
        'subscription_ends_at',
        'subscription_status',
        'holding_balance',
        'withdrawable_balance',
        'commission_rate'
    ];

    /**
     * Checks if the store currently has an active subscription or trial.
     */
    public function hasActiveSubscription(): bool
    {
        return ($this->subscription_status === 'active' && $this->subscription_ends_at?->isFuture()) ||
               ($this->subscription_status === 'trial' && $this->trial_ends_at?->isFuture());
    }

    protected $casts = [
        'subscription_ends_at' => 'datetime',
        'trial_ends_at' => 'datetime',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function payment_requests()
    {
        return $this->hasMany(PaymentRequest::class);
    }

    public function subscription_method_id()
    {
        return $this->belongsTo(SubscriptionMethod::class, 'subscription_method_id');
    }

    public function wilayas()
    {
        return $this->belongsToMany(Wilaya::class, 'store_wilayas')
            ->withPivot('base_weight', 'price_to_home', 'price_to_office', 'extra_price_per_kg_home', 'extra_price_per_kg_office')
            ->withTimestamps();
    }

    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
