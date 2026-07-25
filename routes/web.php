<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\EventController as EventAdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\MidtransWebhookController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Auth;


// Route User Area
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

Route::get('/auth/google', [GoogleController::class, 'redirect'])
    ->name('google.login');

Route::get('/auth/google/callback', [GoogleController::class, 'callback'])
    ->name('google.callback');

//Checkout
Route::middleware('auth')->group(function () {

    // Checkout
    Route::get('/checkout/{event}', [CheckoutController::class, 'create'])
        ->name('checkout.create');

    Route::post('/checkout/{event}', [CheckoutController::class, 'store'])
        ->name('checkout.store');

    // Tiket Saya
    Route::get('/my-ticket', [EventController::class, 'ticket'])
        ->name('ticket');

    // Pembayaran
    Route::get('/checkout/payment/{order_id}', [CheckoutController::class, 'payment'])
        ->name('checkout.payment');

    // Halaman sukses
    Route::get('/success/{order_id}', [CheckoutController::class, 'success'])
        ->name('checkout.success');
});

// Route Admin Area
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Route User Area
Route::get('/login', function () {
    return view('user.login');
})->name('login');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('home');
})->name('logout');

//Route Midtrans
Route::post('/midtrans/callback', [MidtransWebhookController::class, 'handle']);

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

        // pengurus
        Route::resource('jabatan', JabatanController::class);

        Route::resource('pengurus', PengurusController::class);

        Route::get('transactions', [TransactionController::class, 'index'])
            ->name('transactions.index');
    });
});
