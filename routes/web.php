<?php

use App\Http\Controllers\Staff\ResidentController;
use App\Http\Controllers\Staff\FacilityController;
use App\Http\Controllers\Staff\LogController;
use App\Http\Controllers\Staff\ReservationController;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\Staff\XmlController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Resident\ResidentPortalController;
use App\Http\Controllers\Resident\ResidentAuthController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// for the public-facing pages
Route::prefix('public')->name('public.')->group(function () {
    Route::get('/home', function() {
        return view('public-facing.home');
    })->name('home');
    Route::get('/facility', function() {
        return view('public-facing.facilities');
    })->name('facility');
    Route::get('/about', function () {
        return view('public-facing.about');
    })->name('about');
    Route::get('/contact', function() {
        return view('public-facing.contact');
    })->name('contact');
    Route::get('/privacy-policy', function() {
        return view('public-facing.privacy-policy');
    })->name('privacy-policy');
    Route::get('/terms-and-conditions', function() {
        return view('public-facing.toc');
    })->name('toc');
});

Route::middleware(['auth', 'role:staff,admin'])->prefix('staff')->group(function () {
    Route::get('dashboard', [ReservationController::class, 'dashboardData'])->name('staff.dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/log', [LogController::class, 'index'])->name('log.index');

    Route::resource('facility', FacilityController::class);
    Route::resource('residents', ResidentController::class);
    Route::resource('reservation', ReservationController::class);
    Route::resource('/employees', StaffController::class);

    Route::prefix('xml')->name('xml.')->group(function() {
        Route::get('/',        [XmlController::class, 'index'])->name('index');
        Route::post('/export/{entity}',        [XmlController::class, 'export'])->name('export');
        Route::post('/import/{entity}',        [XmlController::class, 'import'])->name('import');
        Route::delete('/reset',                [XmlController::class, 'reset'])->name('reset');
    });
});

// i don't remember what this was for.
// Route::middleware(['auth', 'role:resident'])->group(function () {
//     Route::get('/resident/dashboard', [ResidentController::class, 'dashboard']);
// });

Route::prefix('resident')->name('resident.')->group(function() {
    Route::get('/register', [ResidentAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [ResidentAuthController::class, 'register'])->name('register.store');

    Route::get('/login', [ResidentAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [ResidentAuthController::class, 'login'])->name('login.store');
});

Route::prefix('resident')->name('resident.')->middleware(['auth', 'status:Active','role:resident'])->group(function () {
    Route::get('dashboard', [ResidentPortalController::class, 'dashboard'])->name('dashboard'); //supposed to return all values relating the dashboard page
    Route::get('my-reservations' , [ResidentPortalController::class, 'reservations'])->name('my-reservations'); //suppsoed to return only the reservations of a resident
});

require __DIR__.'/auth.php';
