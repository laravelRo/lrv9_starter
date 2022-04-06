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
});
