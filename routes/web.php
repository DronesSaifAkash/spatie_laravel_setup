<?php

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
});

require __DIR__.'/auth.php';

// Route::group(['middleware' => ['role:super-admin|admin']], function() {
Route::group(['middleware' => ['isAdmin']], function() {

    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::get('permissions/{id}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);
    // ->middleware('permission:Delete role');
    
    
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::get('roles/{id}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
    
    Route::get('roles/{id}/give-permission', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{id}/give-permission', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);
    
    
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::get('users/{id}/delete', [App\Http\Controllers\UserController::class, 'destroy']);
    
});


// Route::middleware('isAdmin')->group( function () {
 
// });