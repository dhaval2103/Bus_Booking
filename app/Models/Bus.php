<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'no',
        'source',
        'destination',
        'route',
        'time',
        'seats',
        'price',
    ];
}