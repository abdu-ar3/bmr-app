<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Booking Room Details') }}
        </h2>
    </x-slot>
    <div class="container mx-auto py-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
            @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
            @endif
            @if(session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                {{ session('error') }}
            </div>
            @endif

            <div class="item-card flex flex-col gap-y-3">
                <div class="flex flex-row items-center gap-x-3">
                    <div class="flex flex-col">
                        <h3 class="text-indigo-950 text-2xl font-bold">{{ $room->name }}</h3>
                        <p class="text-slate-500 text-sm">{{ $room->location }}</p>
                        <p class="text-slate-500 text-sm">Capacity: {{ $room->capacity }}</p>
                        <p class="text-slate-500 text-sm">
                            Status:
                            @if ($room->isCurrentlyBooked())
                            <span class="text-red-500">Booked</span>
                            @else
                            <span class="text-green-500">Available</span>
                            @endif
                        </p>
                        @if (!$room->isCurrentlyBooked())
                        <form method="POST" action="{{ route('user.room.store') }}">
                            @csrf
                            <div class="flex flex-col gap-y-2">
                                <label for="start_time">Start Date:</label>
                                <input type="date" id="start_time" name="start_time" required>
                            </div>
                            <div class="flex flex-col gap-y-2">
                                <label for="start_clock">Start Time:</label>
                                <input type="time" id="start_clock" name="start_clock" required>
                            </div>
                            <div class="flex flex-col gap-y-2">
                                <label for="end_time">End Date:</label>
                                <input type="date" id="end_time" name="end_time" required>
                            </div>
                            <div class="flex flex-col gap-y-2">
                                <label for="end_clock">End Time:</label>
                                <input type="time" id="end_clock" name="end_clock" required>
                            </div>
                            <input type="hidden" name="room_id" value="{{ $room->id }}">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">Book
                                Room</button>
                        </form>
                        @endif
                    </div>
                </div>
                @if ($room->isCurrentlyBooked())
                <div class="mt-5">
                    <h4 class="text-lg font-bold">Booking Details</h4>
                    @foreach ($room->bookings as $booking)
                    @if ($booking->status == 'booked')
                    <div class="bg-gray-100 p-3 rounded-lg mt-3">
                        <p><strong>Booking Name:</strong> {{ $booking->user->name }}</p>
                        <p><strong>Start Date:</strong> {{ date('l, d F Y', strtotime($booking->start_time)) }}
                        </p>
                        <p><strong>Start Clock:</strong> {{
                            date('H : i', strtotime($booking->start_clock)) }}
                        </p>
                        <p><strong>End Time:</strong>{{ date('l, d F Y', strtotime($booking->end_time . ' ' .
                            $booking->end_clock)) }}</p>
                        <p><strong>End Clock:</strong> {{
                            date('H : i', strtotime($booking->end_clock)) }}
                        </p>
                    </div>
                    @endif
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>