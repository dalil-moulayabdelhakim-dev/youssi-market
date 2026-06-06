<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    protected $fillable = ['name', 'ar_name', 'daira_id'];
    public $timestamps = false;

    public function daira()
    {
        return $this->belongsTo(Daira::class, 'daira_id');
    }
}
