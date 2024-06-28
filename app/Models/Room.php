<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'capacity', 'status', 'category_id'];

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

  

    public function isBookedDuring($startDate, $startClock, $endDate, $endClock)
    {
         
        $startDateTime = Carbon::parse("$startDate $startClock");
        $endDateTime = Carbon::parse("$endDate $endClock");

        return $this->bookings()
                    ->where(function ($query) use ($startDate, $startClock, $endDate, $endClock, $startDateTime, $endDateTime) {
                        $query->where(function ($subQuery) use ($startDate, $startClock, $endDate, $endClock, $startDateTime, $endDateTime) {
                            // Check if booking dates overlap
                            $subQuery->where('start_time', '<=', $endDate)
                                    ->where('end_time', '>=', $startDate)
                                    ->where(function ($timeQuery) use ($startClock, $endClock) {
                                        // Check if booking times overlap within the same dates
                                        $timeQuery->where(function ($clockQuery) use ($startClock, $endClock) {
                                            $clockQuery->where('start_clock', '<=', $endClock)
                                                        ->where('end_clock', '>=', $startClock);
                                        });
                                    });
                        });
                    })
                    ->exists();
    }

}
