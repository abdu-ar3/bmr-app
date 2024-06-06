<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Booking Room') }}
            </h2>

        </div>
    </x-slot>

    <div class="container mx-auto py-6">
        <div
            class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach ($rooms as $room)
            <a href="{{ route('rooms.show', ['room' => $room->id]) }}"
                class="card bg-white p-5 rounded-lg shadow-md hover:bg-gray-100 transition">
                <div class="item-card flex flex-col gap-y-3">
                    <div class="flex flex-row items-center gap-x-3">
                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $room->name }}</h3>
                            <p class="text-slate-500 text-sm">{{ $room->location }}</p>
                            <p class="text-slate-500 text-sm">Capacity: {{ $room->capacity }}</p>
                            <p class="text-slate-500 text-sm">
                                Status:
                                @if ($room->isBooked())
                                <span class="text-red-500">Booked</span>
                                @else
                                <span class="text-green-500">Available</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</x-app-layout>