<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreWilaya extends Model
{
     protected $fillable = [
        'store_id',
        'wilaya_id',
        'price_to_home',
        'price_to_office',
    ];
}
