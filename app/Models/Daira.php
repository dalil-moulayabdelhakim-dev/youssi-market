<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Daira extends Model
{
     protected $fillable = ['name', 'ar_name', 'wilaya_id'];
    public $timestamps = false;

    public function wilaya()
    {
        return $this->belongsTo(Wilaya::class, 'wilaya_id');
    }

    public function communes()
    {
        return $this->hasMany(Commune::class);
    }
}
