<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

Route::middleware(['auth'])->group(function () {

    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index')->middleware('can:view-user');
        Route::get('/users/{id}/edit', 'edit');
        Route::put('/users/{id}', 'update');
        Route::delete('/users/{id}', 'destroy');
    });

    Route::controller(RoleController::class)
        ->middleware('can:manage-roles')
        ->group(function () {
            Route::get('/roles', 'index');
            Route::get('/roles/{id}/edit', 'edit');
            Route::put('/roles/{id}', 'update');
        });

});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {

    if(!Gate::allows('access-admin')){
        abort(403);
    }   

    return "Admin Dashboard";
})->middleware('role:admin');

Route::get('/test-edit/{id}', function($id){
    $user = User::findOrFail($id);

    //check policy
    if (!Gate::allows('update', $user)) {
        abort(403);
    }

    return 'You can edit this user';

})->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
