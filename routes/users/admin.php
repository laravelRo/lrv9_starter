<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Users\SettingsController;


Route::prefix('users')->name('user.')->group(function () {

    //rutele guest
    Route::middleware(['guest'])->group(function () {
    });

    //rutele de administrare
    Route::middleware(['auth'])->group(function () {
        //afisam panoul de control pentru utilizatorul logat
        Route::get('settings', [SettingsController::class, 'userSettings'])->name('settings');
    });
});
