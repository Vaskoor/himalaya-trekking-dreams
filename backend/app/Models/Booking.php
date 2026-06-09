<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'booking_number', 'trek_id', 'user_id', 'name', 'email', 'phone', 'country',
        'start_date', 'number_of_people', 'total_amount', 'special_requests',
        'emergency_contact', 'status'
    ];
    public function trek() { return $this->belongsTo(Trek::class); }
}
