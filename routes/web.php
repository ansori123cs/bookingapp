<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

//routes kelola kost
Route::get('/kelolaKost', [KostController::class, 'index'])->name('Kost');
Route::post('/addDataKost', [KostController::class, 'addDataKost'])->name('kost.addDataKost');
Route::post('kelolaKost/{project}/edit', [KostController::class, 'editDataKost'])->name('kost.editDataKost');
Route::post('kelolaKost/{project}/delete', [KostController::class, 'deleteDataKost'])->name('kost.deleteDataKost');
//routes kelola booking
Route::get('/booking', [BookingController::class, 'index'])->name('home');
Route::post('/addDataBooking', [BookingController::class, 'addDataBooking'])->name('booking.addDataBooking');
Route::post('booking/{project}/edit', [BookingController::class, 'editDataBooking'])->name('booking.editDataBooking');
Route::post('booking/{project}/delete', [BookingController::class, 'deleteDataBooking'])->name('booking.deleteDataBooking');
