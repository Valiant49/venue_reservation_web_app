<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\XmlController;
use Illuminate\Routing\Router;
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

    Route::resource('facility', FacilityController::class);
    Route::resource('client', ClientController::class);
    Route::resource('reservation', ReservationController::class);

    Route::prefix('xml')->name('xml.')->group(function() {
        Route::get('/',        [XmlController::class, 'index'])->name('index');
        Route::post('/export/{entity}',        [XmlController::class, 'export'])->name('export');
        Route::post('/import/{entity}',        [XmlController::class, 'import'])->name('import');
    });
});

require __DIR__.'/auth.php';
