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
                        <form method="GET" action="{{ route('rooms.show', ['room' => $room->id]) }}">
                            <div class="flex flex-col gap-y-2">
                                <label for="start_time">Pilih Tanggal Mulai:</label>
                                <input type="date" id="start_time" name="start_time"
                                    value="{{ request('start_time') }}">
                            </div>
                            <div class="flex flex-col gap-y-2">
                                <label for="start_clock">Pilih Jam Mulai:</label>
                                <input type="time" id="start_clock" name="start_clock"
                                    value="{{ request('start_clock') }}">
                            </div>
                            <div class="flex flex-col gap-y-2">
                                <label for="end_time">Pilih Tanggal Selesai:</label>
                                <input type="date" id="end_time" name="end_time" value="{{ request('end_time') }}">
                            </div>
                            <div class="flex flex-col gap-y-2">
                                <label for="end_clock">Pilih Jam Selesai:</label>
                                <input type="time" id="end_clock" name="end_clock" value="{{ request('end_clock') }}">
                            </div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">Cek
                                Ketersediaan</button>
                        </form>

                        @if (request('start_time') && request('start_clock') && request('end_time') &&
                        request('end_clock'))
                        @if (!$room->isBookedDuring(request('start_time'), request('start_clock'),
                        request('end_time'),
                        request('end_clock')))
                        <form method="POST" action="{{ route('user.room.store') }}">
                            @csrf
                            <input type="hidden" name="start_time" value="{{ request('start_time') }}">
                            <input type="hidden" name="start_clock" value="{{ request('start_clock') }}">
                            <input type="hidden" name="end_time" value="{{ request('end_time') }}">
                            <input type="hidden" name="end_clock" value="{{ request('end_clock') }}">
                            <input type="hidden" name="room_id" value="{{ $room->id }}">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">Book
                                Room</button>
                        </form>
                        @else
                        <div class="py-3 w-full rounded-3xl bg-yellow-500 text-white mt-4">
                            Ruangan sudah dibooking untuk waktu yang dipilih.
                        </div>
                        @endif
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


    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');
        form.addEventListener('submit', function (event) {
        const startTime = document.querySelector('#start_time').value;
        const startClock = document.querySelector('#start_clock').value;
        const endTime = document.querySelector('#end_time').value;
        const endClock = document.querySelector('#end_clock').value;
        
        const start = new Date(`${startTime}T${startClock}`);
        const end = new Date(`${endTime}T${endClock}`);
        
        if (end <= start) { event.preventDefault(); alert('End time must be after start time.'); } }); });
    </script> --}}
</x-app-layout>