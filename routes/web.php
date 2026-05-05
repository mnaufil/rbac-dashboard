<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;

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

// Route::get('/admin', function () {
//     if(!Gate::allows('access-admin')){
//         abort(403);
//     }   
//     return "Admin Dashboard";
// })->middleware('role:admin');

Route::get('/dashboard', function () {

    $stats = [
        'users' => User::count(),
        'roles' => Role::count(),
        'permissions' => Permission::count(),
    ];

    $recentUsers = User::latest()->take(5)->get();

    return view('dashboard', compact('stats', 'recentUsers'));

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
