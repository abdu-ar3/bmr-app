<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Wel Done Activity') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">

                @if(session('status'))
                <div class="py-3 w-full rounded-3xl bg-green-500 text-white">
                    {{ session('status') }}
                </div>
                @endif

                <!-- Key Room Section -->
                <p class="text-indigo-950 text-xl font-bold text-center py-2">Key Room</p>
                @foreach($availableKeys as $key)
                @if($key->room && $key->room->bookings->first())
                <div class="item-card flex flex-col md:flex-row gap-y-10 justify-between md:items-center py-2">
                    <div class="flex flex-col md:flex-row gap-y-2 md:gap-x-10">
                        <div>
                            <p class="text-indigo-950 text-xl font-bold">{{ $key->room->name }}</p>
                            <p class="text-indigo-950 text-l">Booked By: {{ $key->room->bookings->first()->user->name }}
                            </p>
                            <p class="text-indigo-950 text-l">Start Time: {{ date('l, d F Y H:i',
                                strtotime($key->room->bookings->first()->start_time)) }}</p>
                            <p class="text-indigo-950 text-l">End Time: {{ date('l, d F Y H:i',
                                strtotime($key->room->bookings->first()->end_time)) }}</p>
                        </div>
                        <div>
                            <p class="text-indigo-950 text-l">Key Status: {{ $key->status }}</p>
                        </div>
                    </div>
                    <div class="flex flex-row gap-x-2">
                        @if($key->room->bookings->first()->user->id == auth()->id() && $key->status == 'available')
                        <form method="POST" action="{{ route('user.keyRoom.takeKey', $key->id) }}">
                            @csrf
                            <button type="submit" class="font-bold py-2 px-4 bg-indigo-700 text-white rounded-full">
                                Take the Key
                            </button>
                        </form>
                        @else
                        <button class="font-bold py-2 px-4 bg-gray-500 text-white rounded-full" disabled>
                            Key Taken
                        </button>
                        @endif
                    </div>
                </div>
                @endif
                @endforeach

            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">

                @if($errors->any())
                @foreach($errors->all() as $error)
                <div class="py-3 w-full rounded-3xl bg-red-500 text-white">
                    {{$error}}
                </div>
                @endforeach
                @endif

                <p class="text-indigo-950 text-xl font-bold text-center py-2">Return Key</p>

                @foreach($takenKeys as $key)
                @if($key->room && $key->room->bookings->first())
                <div class="item-card flex flex-col md:flex-row gap-y-10 justify-between md:items-center py-2">
                    <div class="flex flex-col md:flex-row gap-y-2 md:gap-x-10">
                        <div>
                            <p class="text-indigo-950 text-xl font-bold">{{ $key->room->name }}</p>
                            <p class="text-indigo-950 text-l">Booked By: {{ $key->room->bookings->first()->user->name }}
                            </p>
                            <p class="text-indigo-950 text-l">Start Time: {{ date('l, d F Y H:i',
                                strtotime($key->room->bookings->first()->start_time)) }}</p>
                            <p class="text-indigo-950 text-l">End Time: {{ date('l, d F Y H:i',
                                strtotime($key->room->bookings->first()->end_time)) }}</p>
                        </div>
                        <div>
                            <p class="text-indigo-950 text-l">Key Status: {{ $key->status }}</p>
                        </div>
                    </div>
                    <div class="flex flex-row gap-x-2">
                        <form method="POST" action="{{ route('user.returnKey', $key->id) }}">
                            @csrf
                            <button type="submit" class="font-bold py-2 px-4 bg-indigo-700 text-white rounded-full">
                                <i class="fa fa-refresh" aria-hidden="true"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @endif
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>