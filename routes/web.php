<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;

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
});

require __DIR__.'/auth.php';

// Route::group(['middleware' => ['role:super-admin|admin']], function() {
Route::group(['middleware' => ['isAdmin']], function() {

    // Route::get('/logout', [AdminController::class, 'adminLogout'])->name('logout');
    Route::get('resetcronflags', [AdminController::class, 'resetcronflags'])->name('resetcronflags');
    Route::post('resetCron', [AdminController::class, 'resetCron'])->name('resetCron');

    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::get('permissions/{id}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);
    // ->middleware('permission:Delete role');
    
    
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::get('roles/{id}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
    
    Route::get('roles/{id}/give-permission', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{id}/give-permission', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);
    
    
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::get('users/{id}/delete', [App\Http\Controllers\UserController::class, 'destroy']);


    Route::get('/moments-records', [AdminController::class, 'moments_newList'])->name('moments_newList');
    Route::post('update_product', [AdminController::class, 'update_product'])->name('update_product');


    Route::get('moments-add', [AdminController::class, 'moments_add'])->name('moments_add');
    Route::post('delete_moments', [AdminController::class, 'delete_moments'])->name('delete_moments');
    Route::post('moments-add-edit', [AdminController::class, 'moments_add_edit'])->name('moments_add_edit');
    Route::post('moment-adding', [AdminController::class, 'moment_adding'])->name('moment_adding');

    Route::get('moment-score-update', [AdminController::class, 'moment_score_update'])->name('moment_score_update');
    Route::post('moment_score_updater_fun', [AdminController::class, 'moment_score_updater_fun'])->name('moment_score_updater_fun');

    
});


// Route::middleware('isAdmin')->group( function () {
 
// });