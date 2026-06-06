<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionMethod extends Model
{
    protected $fillable = [
        'name',
        'price',
        'display_name_en',
        'display_name_ar',
        'features_en',
        'features_ar',
    ];

    public function stores()
    {
        return $this->hasMany(Store::class);
    }
}
