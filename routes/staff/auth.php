<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Staff\AuthController;


Route::prefix('staf')->name('staf.')->group(function () {

    //rutele guest
    Route::middleware(['guest:staf'])->group(function () {
        //ruta de logare pentru staff:
        Route::get('/login', [AuthController::class, 'loginStaff'])->name('login');
        Route::post('/login', [AuthController::class, 'authStaff'])->name('auth');
    });

    //rutele de administrare
    Route::middleware(['auth:staf'])->group(function () {
        Route::get('control-panel', [AuthController::class, 'viewCpanel'])->name('cpanel');
        Route::post('logout', [AuthController::class, 'logoutStaff'])->name('logout');
    });
});
