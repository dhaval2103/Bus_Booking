<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'ticket_no',
        'user_id',
        'bus_id',
        'date',
        'book_seat',
        'price',
        'total_price',
        'status'
    ];
}