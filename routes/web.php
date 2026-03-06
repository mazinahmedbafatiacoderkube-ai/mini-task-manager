<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (Auth::check()) {

        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('user.dashboard');
    }

    return redirect()->route('login');
});



/*
|--------------------------------------------------------------------------
| USER ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','role:user','prevent-back-history'])->group(function () {

    Route::get('/user/dashboard',
        [UserDashboardController::class,'index']
    )->name('user.dashboard');

    Route::get('/tasks/create',
        [TaskController::class,'create']
    )->name('user.tasks.create');

    Route::post('/tasks/store',
        [TaskController::class,'store']
    )->name('user.tasks.store');

    Route::get('/tasks/{id}/edit',
        [TaskController::class,'edit']
    )->name('user.tasks.edit');

    Route::put('/tasks/{id}',
        [TaskController::class,'update']
    )->name('user.tasks.update');

    Route::delete('/tasks/{id}',
        [TaskController::class,'destroy']
    )->name('user.tasks.destroy');

});



/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','role:admin','prevent-back-history'])->group(function () {

    Route::get('/admin/dashboard',
        [AdminDashboardController::class,'index']
    )->name('admin.dashboard');

    Route::delete('/admin/user/{user}',
        [AdminDashboardController::class,'destroyUser']
    )->name('admin.user.delete');

    Route::delete('/admin/task/{task}',
        [TaskController::class,'destroy']
    )->name('admin.task.delete');

});



/*
|--------------------------------------------------------------------------
| PROFILE ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile',
        [ProfileController::class,'edit']
    )->name('profile.edit');

    Route::patch('/profile',
        [ProfileController::class,'update']
    )->name('profile.update');

    Route::delete('/profile',
        [ProfileController::class,'destroy']
    )->name('profile.destroy');

});

// Route::post('/logout', function () {
//     Auth::logout();
//     session()->invalidate();
//     session()->regenerateToken();

//     return redirect('/login');
// })->name('logout');

require __DIR__.'/auth.php';