<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'booking_id',
        'name',
        'email',
        'gender',
        'age',
    ];

    public function passengerDetail()
    {
        return $this->belongsTo(Booking::class, 'booking_id','id');
    }
}