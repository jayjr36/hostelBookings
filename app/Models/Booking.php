<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'hostel_name', 'home_address','disability', 'guardian_name', 'guardian_contact', 'relationship', 'duration', 'price', 'room_number', 'payment_status'];

    public function student()
    {
        return $this->belongsTo(User::class);
    }

}
