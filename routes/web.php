<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::prefix('user')->name('user.')->group(function(){
        Route::resource('booking', BookingController::class)->middleware('role:user');
        Route::resource('room', RoomController::class)->middleware('role:user');
        Route::post('/rooms/{room}/book', [RoomController::class, 'book'])->name('rooms.book');
    });
    Route::get('/booking/{room}', [RoomController::class, 'show'])->name('rooms.show');
    

});

require __DIR__.'/auth.php';
