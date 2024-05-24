<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HostelController;
use App\Http\Controllers\BookingController;

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/register', function () {
    return view('auth.register');
})->name('user.register');

Route::get('/', function () {
    return view('auth.login');
})->name('user.login');

Route::get('/landing', function () {
    return view('landing');
})->name('landing.page');

Route::post('/add-hostel', [HostelController::class, 'store'])->name('hostels.store');
Route::get('/hostels', [HostelController::class, 'index'])->name('hostels.index');
Route::get('/hostels/{id}', [HostelController::class, 'show'])->name('hostels.show');
Route::post('/booking/{id}/payment', [BookingController::class, 'makePayment'])->name('make.payment');
Route::get('/bookings', [BookingController::class, 'userBookings'])->name('user.bookings');
Route::post('/book', [BookingController::class, 'store'])->name('store.bookings');
Route::post('/update-balance', [UserController::class,'updateBalance'],)->name('update.balance');
Auth::routes();
Route::get('/download-receipt/{id}', [BookingController::class, 'downloadReceipt'])->name('download.receipt');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
