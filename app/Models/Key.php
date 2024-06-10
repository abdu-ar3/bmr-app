<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    use HasFactory;

    protected $fillable = ['room_id', 'status', 'taken_at', 'returned_at'];

    // Relasi ke Room
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    // Relasi ke Booking (opsional)
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'room_id', 'room_id');
    }
}
