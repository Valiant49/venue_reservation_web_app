<?php

use App\Http\Controllers\ResidentController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\XmlController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// routes/web.php — outside any middleware group, at the top level
Route::get('/', function () {
    return view('public-facing.home');
})->name('home');

Route::get('/', function () {
    return view('public-facing.facilities');
})->name('home');

Route::get('/about', function () {
    return view('public.about');
})->name('about');

Route::get('/contact', function () {
    return view('public.contact');
})->name('contact');

// Route::get('/dashboard', [ReservationController::class, 'dashboardData'])
//     ->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', function() {
    return match (true) {
        auth()->user()->role === 'resident' => redirect()->route('resident.dashboard'),
        in_array(auth()->user()->role, ['admin', 'staff']) => redirect()->route('staff.dashboard'),
        default => abort(403),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:staff,admin'])->group(function () {
    Route::get('/staff/dashboard', [ReservationController::class, 'dashboardData'])->name('staff.dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/log', [LogController::class, 'index'])->name('log.index');

    Route::resource('facility', FacilityController::class);
    Route::resource('residents', ResidentController::class);
    Route::resource('reservation', ReservationController::class);
    Route::resource('/staff', StaffController::class);

    Route::prefix('xml')->name('xml.')->group(function() {
        Route::get('/',        [XmlController::class, 'index'])->name('index');
        Route::post('/export/{entity}',        [XmlController::class, 'export'])->name('export');
        Route::post('/import/{entity}',        [XmlController::class, 'import'])->name('import');
        Route::delete('/reset',                [XmlController::class, 'reset'])->name('reset');
    });
});

Route::middleware(['auth', 'role:resident'])->group(function () {
    Route::get('/resident/dashboard', [ResidentController::class, 'dashboard']);
});

Route::prefix('resident')->name('resident.')->middleware(['auth', 'role:resident'])->group(function () {
    Route::get('/dashboard', [ResidentPortalController::class, 'dashboard'])->name('dashboard');
    // future: reservation booking, own profile, etc.
});

require __DIR__.'/auth.php';
