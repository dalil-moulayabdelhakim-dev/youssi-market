<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeleveryArea extends Model
{
    protected $fillable = [
        'name',
        'ar_name',
        'home_price',
        'SD_price',
    ];
}
