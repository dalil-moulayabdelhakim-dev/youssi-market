<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionMethod extends Model
{
    protected $fillable = [
        'name',
        'price',
        'duration_days',
        'display_name_en',
        'display_name_ar',
        'features_en',
        'features_ar',
    ];

    protected $casts = [
        'price' => 'integer',
        'duration_days' => 'integer',
    ];

    public function stores()
    {
        return $this->hasMany(Store::class);
    }
}
