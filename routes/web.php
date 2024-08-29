<?php

use App\Http\Controllers\HnrdaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // HNRDA CRUD operations
    Route::get('/hnrda',[HnrdaController::class, 'index'])->name('hnrda.index');
    Route::get('/hnrda/create', [HnrdaController::class, 'create'])->name('hnrda.create');
    Route::post('/hnrda', [HnrdaController::class, 'store'])->name('hnrda.store');
    Route::get('/hnrda/{hnrda}/edit', [HnrdaController::class, 'edit'])->name('hnrda.edit');
    Route::put('/hnrda/{hnrda}/update', [HnrdaController::class, 'update'])->name('hnrda.update');
    Route::delete('/hnrda/{hnrda}/destroy', [HnrdaController::class, 'destroy'])->name('hnrda.destroy');

    Route::get('/users',[UserController::class, 'index'])->name('user.index');
    // to register
    Route::post('/users', [UserController::class, 'store'])->name('user.register');
    Route::get('/user/{user}/edit', [HnrdaController::class, 'edit'])->name('user.edit');
    Route::delete('/user/{user}/destroy', [HnrdaController::class, 'destroy'])->name('user.destroy');

});

require __DIR__.'/auth.php';
