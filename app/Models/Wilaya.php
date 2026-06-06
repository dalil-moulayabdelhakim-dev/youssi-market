<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wilaya extends Model
{

    public $timestamps = false;
    protected $fillable = [
        'name',
        'ar_name',
    ];

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'store_wilaya')
            ->withPivot('price_to_home', 'price_to_office')
            ->withTimestamps();
    }

    public function dairas()
    {
        return $this->hasMany(Daira::class);
    }

    public function communes()
    {
        // عبر الدوائر
        return $this->hasManyThrough(Commune::class, Daira::class);
    }
}
