<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'booking_id',
        'cardholder_name',
        'card_number',
        'card_expiry',
        'card_cvv',
        'payment_amount',
    ];
}
