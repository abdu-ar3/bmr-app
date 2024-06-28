<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Category Room') }}
            </h2>

        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                <h2 class="text-2xl font-bold mb-4">Categories</h2>
                <ul>
                    <div class="container mx-auto py-6">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
                                @foreach ($categories as $category)
                                <div class="mb-6">
                                    <h2 class="text-2xl font-bold mb-4">{{ $category->name }}</h2>
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                                        @foreach ($category->rooms as $room)
                                        <a href="{{ route('rooms.show', ['room' => $room->id]) }}"
                                            class="card bg-white p-5 rounded-lg shadow-md hover:bg-gray-100 transition">
                                            <div class="item-card flex flex-col gap-y-3">
                                                <div class="flex flex-row items-center gap-x-3">
                                                    <div class="flex flex-col">
                                                        <h3 class="text-indigo-950 text-xl font-bold">{{ $room->name }}
                                                        </h3>
                                                        <p class="text-slate-500 text-sm">{{ $room->location }}</p>
                                                        <p class="text-slate-500 text-sm">Capacity: {{ $room->capacity
                                                            }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>