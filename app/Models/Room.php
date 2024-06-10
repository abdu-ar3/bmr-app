<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'capacity'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function isBooked()
    {
        return $this->bookings()->where('status', 'booked')->exists();
    }

    public function isCurrentlyBooked()
    {
        return $this->bookings()->where('status', 'booked')->exists();
    }

}
