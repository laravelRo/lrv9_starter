<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Staff\UsersController;


// ==========
// RUTELE DE ADMINISTAREA A UTILIZATORILOR
// ==========
Route::prefix('staf/users/')->name('staf.users.')->middleware(['auth:staf', 'supervisor'])->group(function () {

    //LISTAM UTILIZATORII
    Route::get('list', [UsersController::class, 'listUsers'])->name('list');

    //Editam utilizatorul selectat
    Route::get('edit/{id}', [UsersController::class, 'editUsers'])->name('edit');
    //actualizam datele utilizatorului selectat
    Route::put('update/{id}', [UsersController::class, 'updateUsers'])->name('update');

    //blocam utilizatorul selectat
    Route::delete('user-block/{id}', [UsersController::class, 'blockUser'])->name('block');

    //setergem definitiv utilizatorul selectat
    Route::delete('user-delete/{id}', [UsersController::class, 'deleteUser'])->name('delete');

    //reactivam utilizatorul selectat
    Route::post('user-restore/{id}', [UsersController::class, 'restoreUser'])->name('restore');
});
