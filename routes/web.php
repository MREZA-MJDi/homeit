<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TechnicianProfileController;
use App\Http\Controllers\TechnicianServiceController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | User Profile
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'technician-profiles',
        TechnicianProfileController::class
    )->except([
        'create',
        'edit'
    ]);

    Route::resource(
        'technician-services',
        TechnicianServiceController::class
    )->except([
        'create',
        'edit'
    ]);

});
Route::middleware(['auth', 'verified'])->group(function () {

    Route::resource('orders', OrderController::class)
        ->except([
            'create',
            'edit',
            'destroy'
        ]);

    Route::patch(
        'orders/{order}/assign-technician',
        [OrderController::class, 'assignTechnician']
    )->name('orders.assign-technician');

    Route::patch(
        'orders/{order}/accept',
        [OrderController::class, 'accept']
    )->name('orders.accept');

    Route::patch(
        'orders/{order}/on-the-way',
        [OrderController::class, 'onTheWay']
    )->name('orders.on-the-way');

    Route::patch(
        'orders/{order}/start',
        [OrderController::class, 'start']
    )->name('orders.start');

    Route::patch(
        'orders/{order}/complete',
        [OrderController::class, 'complete'
        ])->name('orders.complete');

    Route::patch(
        'orders/{order}/cancel',
        [OrderController::class, 'cancel']
    )->name('orders.cancel');

});

/*
|--------------------------------------------------------------------------
| Breeze Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

require __DIR__ . '/auth.php';
