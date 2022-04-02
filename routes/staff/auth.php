<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Staff\AuthController;
use App\Http\Controllers\Staff\StaffController;


Route::prefix('staf')->name('staf.')->group(function () {

    //rutele guest
    Route::middleware(['guest:staf'])->group(function () {
        //ruta de logare pentru staff:
        Route::get('/login', [AuthController::class, 'loginStaff'])->name('login');
        Route::post('/login', [AuthController::class, 'authStaff'])->name('auth');
    });

    // ==========
    // RUTELE GENERALE DE administrare
    // ==========
    Route::middleware(['auth:staf'])->group(function () {

        Route::get('control-panel', [AuthController::class, 'viewCpanel'])->name('cpanel');
        Route::post('logout', [AuthController::class, 'logoutStaff'])->name('logout');
    });


    // ==========
    // RUTELE PENTRU SUPERVISOR
    // ==========
    Route::middleware(['auth:staf', 'supervisor'])->group(function () {

        //listam membrii staff-ului
        Route::get('staff-list', [StaffController::class, 'listStaff'])->name('list.staf');

        // =====================
        // ADAUGAREA UNUI MEMBRU STAFF
        // =====================
        //afisam formularul pentru adaugarea unui nou membru
        Route::get('staff-new', [StaffController::class, 'newStaff'])->name('new.staf');
        //functia pentru crearea unui nou membru staff
        Route::post('staff-add', [StaffController::class, 'addStaff'])->name('add.staf');

        // =====================
        // EDITAREA UNUI MEMBRU STAFF
        // =====================
        //afisam formularul pentru editarea unui nou membru
        Route::get('staff-edit/{id}', [StaffController::class, 'editStaff'])->name('edit.staf');
        //functia pentru updatarea unui membru staff
        Route::put('staff-update/{id}', [StaffController::class, 'updateStaff'])->name('update.staf');

        // =====================
        // MODIFICAREA PAROLEI UNUI MEMBRU STAFF
        // =====================
        Route::put('staff-update-pass/{id}', [StaffController::class, 'updatePassStaff'])->name('update.staf.pass');

        // =====================
        // BLOCAREA UNUI MEMBRU STAFF
        // =====================
        Route::delete('staf-block/{id}', [StaffController::class, 'blockStaff'])->name('block.staf');

        // =====================
        // STERGEREA DEFINITIVA UNUI MEMBRU STAFF
        // =====================
        Route::delete('staf-delete/{id}', [StaffController::class, 'deleteStaff'])->name('delete.staf');

        // =====================
        // RE-ACTIVAREA UNUI MEMBRU STAFF
        // =====================
        Route::post('staf-restore/{id}', [StaffController::class, 'restoreStaff'])->name('restore.staf');
    });
});
