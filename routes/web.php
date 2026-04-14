<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DirekturController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

// ROOT → redirect ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// LOGIN
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// PROTECTED ROUTES
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [StateController::class, 'dashboard'])->name('dashboard');
    Route::get('/states/{id}', [StateController::class, 'show'])->name('states.show');
    
    
    Route::get('/astacitapresiden', function () {
        return view('astacita');
    })->name('astacita');

    Route::get('/ICAOheadoffice', function () {
        return view('icaoheadoffice');
    })->name('icaoheadoffice');

    Route::get('/states/{id}/directors', [DirekturController::class, 'show'])->name('direkturs.show');

});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('admin.dashboard');


});
