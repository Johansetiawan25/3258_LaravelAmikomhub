<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\EventController as EventAdminController;
use App\Http\Controllers\Admin\AuthController;

// Route User Area
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::get('/checkout', [EventController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [EventController::class, 'processCheckout'])->name('checkout.process');
Route::get('/my-ticket', [EventController::class, 'ticket'])->name('ticket');

// Route Admin Area
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Route::prefix('admin')->name('admin.')->group(function () {

    // Login
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Route yang dilindungi
    Route::middleware(['auth', 'admin'])->group(function () {

        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('events', EventAdminController::class);

        Route::resource('categories', CategoryController::class);

        Route::resource('partners', PartnerController::class);

        Route::get('transactions', function () {
            return view('admin.transactions.index');
        })->name('transactions.index');
    });
});
