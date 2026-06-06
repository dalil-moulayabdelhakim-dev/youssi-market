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
        'commission_rate'

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
            ->withPivot('price_to_home', 'price_to_office')
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
