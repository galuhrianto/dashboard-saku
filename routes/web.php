<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DirekturController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KerjasamaController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\StateController as AdminStateController;
use App\Http\Controllers\Admin\DirekturController as AdminDirekturController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\HeadOfficeController;

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

    Route::get('/ICAOheadoffice', [HeadOfficeController::class, 'show'])->name('icaoheadoffice');

    Route::get('/states/{id}/directors', [DirekturController::class, 'show'])->name('direkturs.show');
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('head_offices', HeadOfficeController::class);

        Route::get('/states/create', [AdminStateController::class, 'create'])
            ->name('states.create');

        Route::post('/states', [AdminStateController::class, 'store'])
            ->name('states.store');

        Route::get('/states/{state}', [AdminStateController::class, 'show'])->name('states.show');

        Route::get('/states/{state}/edit', [AdminStateController::class, 'edit'])->name('states.edit');
        Route::put('/states/{state}', [AdminStateController::class, 'update'])->name('states.update');
        Route::delete('/states/{state}', [AdminStateController::class, 'destroy'])->name('states.destroy');

        Route::post('/states/{state}/direktur', [AdminDirekturController::class, 'store'])
            ->name('states.direktur.store');

        Route::delete('/direktur/{direktur}', [AdminDirekturController::class, 'destroy'])
            ->name('direktur.destroy');

        Route::post('/states/{state}/kerjasamas', [KerjasamaController::class, 'storeFromState'])
            ->name('states.kerjasamas.store');


        Route::get('/kerjasama', [KerjasamaController::class, 'index'])->name('kerjasama.index');
        Route::get('/kerjasama/create', [KerjasamaController::class, 'create'])->name('kerjasama.create');
        Route::post('/kerjasama', [KerjasamaController::class, 'store'])->name('kerjasama.store');
        Route::get('/kerjasama/{kerjasama}/edit', [KerjasamaController::class, 'edit'])->name('kerjasama.edit');
        Route::put('/kerjasama/{kerjasama}', [KerjasamaController::class, 'update'])->name('kerjasama.update');
        Route::delete('/kerjasama/{kerjasama}', [KerjasamaController::class, 'destroy'])->name('kerjasama.destroy');

        Route::get('/media', [MediaController::class, 'index'])->name('media.index');

        Route::post('/media/aidememoire', [MediaController::class, 'uploadAidememoire'])->name('media.upload.aidememoire');

        Route::post('/media/astacita', [MediaController::class, 'uploadAstaCita'])->name('media.upload.astacita');

        Route::post('/media/office', [MediaController::class, 'storeOffice'])->name('media.office.store');

        Route::delete('/media/office/{office}', [MediaController::class, 'destroyOffice'])->name('media.office.destroy');
    });



    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm']);

    Route::post('/reset-password', [AuthController::class, 'resetPassword']);

    Route::put('/users/{user}/password-mode', [UserController::class, 'passwordMode'])->name('users.password_mode');

    Route::post('/users/{user}/resend-reset', [UserController::class, 'resendReset'])->name('users.resend-reset');