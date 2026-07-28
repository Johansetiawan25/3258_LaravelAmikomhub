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
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\OrganizerController as OrganizerAdminController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Organizer\AuthController as OrganizerAuthController;
use App\Http\Controllers\Organizer\DashboardController as OrganizerDashboardController;
use App\Http\Controllers\Organizer\EventController as OrganizerEventController;
use App\Http\Controllers\UserAuthController;


// Route User Area
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

Route::prefix('organizer')
    ->name('organizer.')
    ->group(function () {

        // Register
        Route::get('/register', [OrganizerAuthController::class, 'showRegister'])
            ->name('register');

        Route::post('/register', [OrganizerAuthController::class, 'register']);

        // Login
        Route::get('/login', [OrganizerAuthController::class, 'showLogin'])
            ->name('login');

        Route::post('/login', [OrganizerAuthController::class, 'login']);

        // Logout
        Route::post('/logout', [OrganizerAuthController::class, 'logout'])
            ->name('logout');

        // Organizer Area
        Route::middleware('organizer')->group(function () {

            // Dashboard
            Route::get('/dashboard', [OrganizerDashboardController::class, 'index'])
                ->name('dashboard');

            // CRUD Event Organizer
            Route::resource('events', OrganizerEventController::class);

            // Pendapatan
            Route::get(
                '/income',
                [OrganizerDashboardController::class, 'income']
            )->name('income');

            // Profile
            Route::get(
                '/profile',
                [OrganizerDashboardController::class, 'profile']
            )->name('profile');

            Route::put(
                '/profile',
                [OrganizerDashboardController::class, 'updateProfile']
            )->name('profile.update');
        });
    });

Route::get('/organizer/{organizer}', [OrganizerController::class, 'show'])
    ->name('organizer.show');

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
    Route::get('/my-ticket/{transaction}', [EventController::class, 'ticketDetail'])
        ->name('ticket.detail');

    // Pembayaran
    Route::get('/checkout/payment/{order_id}', [CheckoutController::class, 'payment'])
        ->name('checkout.payment');

    // Halaman sukses
    Route::get('/success/{order_id}', [CheckoutController::class, 'success'])
        ->name('checkout.success');

    Route::post('/organizers/{organizer}/review', [ReviewController::class, 'store'])
        ->name('reviews.store');
});

// ======================
// User Authentication
// ======================

Route::get('/login', [UserAuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [UserAuthController::class, 'login']);

Route::get('/register', [UserAuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [UserAuthController::class, 'register']);

Route::post('/logout', [UserAuthController::class, 'logout'])
    ->name('logout');

//Route Midtrans
Route::post('/midtrans/callback', [MidtransWebhookController::class, 'handle']);

Route::prefix('admin')->name('admin.')->group(function () {

    // Jika buka /admin langsung diarahkan ke login admin
    Route::redirect('/', '/admin/login');
    // Login
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Route yang dilindungi
    Route::middleware(['admin'])->group(function () {

        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('events', EventAdminController::class);

        Route::resource('categories', CategoryController::class);

        Route::resource('partners', PartnerController::class);

        Route::resource('organizers', OrganizerAdminController::class);

        Route::resource('reviews', AdminReviewController::class)
            ->only([
                'index',
                'show',
                'destroy'
            ]);

        Route::post(
            'organizers/{organizer}/approve',
            [OrganizerAdminController::class, 'approve']
        )
            ->name('organizers.approve');


        Route::post(
            'organizers/{organizer}/reject',
            [OrganizerAdminController::class, 'reject']
        )
            ->name('organizers.reject');

        // pengurus
        Route::resource('jabatan', JabatanController::class);

        Route::resource('pengurus', PengurusController::class);

        Route::get('transactions', [TransactionController::class, 'index'])
            ->name('transactions.index');
    });
});
