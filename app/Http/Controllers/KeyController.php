<?php

namespace App\Http\Controllers;

use App\Models\Key;
use Illuminate\Http\Request;

class KeyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $keys = Key::with(['room', 'room.bookings.user'])->get();
        $availableKeys = $keys->where('status', 'available');
        $takenKeys = $keys->where('status', 'taken');

        return view('user.key.index', compact('availableKeys', 'takenKeys'));

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
    }

    /**
     * Display the specified resource.
     */
    public function show(Key $key)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Key $key)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Key $key)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Key $key)
    {
        //
    }

    public function takeKey(Request $request, Key $key)
    {

        if ($key->room->bookings->first()->user->id == auth()->id()) {
            $key->status = 'taken';
            $key->taken_at = now();
            $key->save();

            return redirect()->back()->with('status', 'Key taken successfully.');
        }

        return redirect()->back()->with('error', 'You are not authorized to take this key.');
    }

    public function returnKey(Request $request, Key $key)
    {
        // Ensure the authenticated user is the one who booked the room
        // Ensure the authenticated user is the one who booked the room
        $booking = $key->room->bookings->first();
        if ($booking->user_id == auth()->id()) {
            // Delete the key
            $key->delete();
            
            // Delete the associated booking
            $booking->delete();

            return redirect()->route('user.booking.index')->with('status', 'Key and booking deleted successfully.');
        }

        return redirect()->back()->with('error', 'You are not authorized to return this key.');
    }
}
