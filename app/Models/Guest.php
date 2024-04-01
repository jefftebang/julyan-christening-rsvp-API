<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_seat_name',
        'first_seat_phone',
        'second_seat_name',
        'second_seat_phone',
        'confirmation'
    ];
}
