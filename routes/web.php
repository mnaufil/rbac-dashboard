<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
