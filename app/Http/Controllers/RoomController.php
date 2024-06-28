<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd('Test');
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'start_time' => 'required|date',
            'start_clock' => 'required',
            'end_time' => 'required|date',
            'end_clock' => 'required',
        ]);

        $room = Room::findOrFail($request->room_id);

        // Check if the room is booked during the requested time
        $startDate = Carbon::parse($request->start_time)->format('Y-m-d');
        $startClock = Carbon::parse($request->start_clock)->format('H:i:s');
        $endDate = Carbon::parse($request->end_time)->format('Y-m-d');
        $endClock = Carbon::parse($request->end_clock)->format('H:i:s');

        if ($room->isBookedDuring($startDate, $startClock, $endDate, $endClock)) {
            return redirect()->back()->with('error', 'Room is already booked during the selected time.');
        }

        $booking = new Booking();
        $booking->room_id = $room->id;
        $booking->user_id = auth()->user()->id; // Assuming using Laravel authentication
        $booking->start_time = $request->start_time;
        $booking->start_clock = $request->start_clock;
        $booking->end_time = $request->end_time;
        $booking->end_clock = $request->end_clock;
        $booking->status = 'booked';

        $booking->save();

        
        return redirect()->route('rooms.show', $room->id)->with('success', 'Room booked successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        //
        // Debug untuk memastikan method terpanggil

        $room->load('bookings.user'); // Load bookings dan user terkait
        return view('user.rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        //
    }

    public function book(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $room = Room::findOrFail($request->room_id);

        if ($room->isCurrentlyBooked()) {
            return redirect()->back()->with('error', 'Room is already booked.');
        }

        Booking::create([
            'room_id' => $room->id,
            'user_id' => Auth::id(),
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => 'booked',
        ]);

        return redirect()->route('rooms.show', $room->id)->with('success', 'Room booked successfully.');
    }
}
