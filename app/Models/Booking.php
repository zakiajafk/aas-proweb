<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'booking_time',
        'service',
        'location',
    ];

    protected $casts = [
        'booking_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}