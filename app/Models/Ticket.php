<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
     protected $fillable = ['user_id','admin_id', 'subject', 'status', 'priority', 'agent_notes'];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function messages() {
        return $this->hasMany(TicketMessage::class)->orderBy('created_at', 'desc');
    }
}
