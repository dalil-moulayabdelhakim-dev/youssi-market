<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdministrativeInformation extends Model
{
    protected $fillable = [
        'email',
        'phone',
        'baridimob',
        'ccp',
        'default_commission_rate',
    ];

}
