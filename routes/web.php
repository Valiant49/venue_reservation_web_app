<?php

use App\Http\Controllers\Staff\ResidentController;
use App\Http\Controllers\Staff\FacilityController;
use App\Http\Controllers\Staff\LogController;
use App\Http\Controllers\Staff\ReservationController;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\Staff\XmlController;
use App\Http\Controllers\Resident\ResidentPortalController;
use App\Http\Controllers\Resident\ResidentAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $user = auth()->user();

    return match ($user->role) {
        'resident' => redirect()->route('resident.dashboard'),
        'staff', 'admin' => redirect()->route('staff.dashboard'),
        default => abort(403),
    };
})->middleware(['auth', 'status:Active'])->name('dashboard');

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
    // Route::get('/facility-viewer/{model}', function($model) {
    //     return view('facility.viewer', compact('model'));
    // })->name('facility.viewer');

    Route::get('/facility-viewer/{model}', function ($model) {
    $path = public_path("models/{$model}.glb");
    abort_unless(file_exists($path), 404);
    return view('facility.viewer', compact('model'));
    })->name('facility.viewer');
});

Route::get('/test-glb', function () {
    return response()->json([
        'exists' => file_exists(public_path('models/clubhouse.glb')),
        'path' => public_path('models/clubhouse.glb'),
    ]);
});

Route::middleware('auth')->group(function() {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:staff,admin'])->prefix('staff')->group(function () {
    Route::get('dashboard', [ReservationController::class, 'dashboardData'])->name('staff.dashboard');

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
    Route::get('facility', [ResidentPortalController::class, 'facility'])->name('available-facility');
    Route::get('my-reservations' , [ResidentPortalController::class, 'reservations'])->name('my-reservations'); //suppsoed to return only the reservations of a resident
});

require __DIR__.'/auth.php';
