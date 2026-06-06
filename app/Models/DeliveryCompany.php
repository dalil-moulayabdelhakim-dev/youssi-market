<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryCompany extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
    ];

    public function delivery_zones()
    {
        return $this->hasMany(DeliveryZone::class);
    }
}
