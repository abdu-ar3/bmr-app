<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'room_id',  'start_time',
        'start_clock',
        'end_time',
        'end_clock', 
        'status'];
    
    public function key()
    {
        return $this->hasOne(Key::class, 'room_id', 'room_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeBookedDuring($query, $startDate, $startClock, $endDate, $endClock)
    {
        $startDateTime = Carbon::parse("$startDate $startClock");
        $endDateTime = Carbon::parse("$endDate $endClock");

        return $query->where(function ($q) use ($startDateTime, $endDateTime) {
            $q->where('start_time', '<=', $endDateTime)
              ->where('end_time', '>=', $startDateTime);
        });
    }
}
