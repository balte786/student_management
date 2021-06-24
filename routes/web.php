<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::post('/fetch-schools', [App\Http\Controllers\SchoolController::class, 'fetchSchools']);

Auth::routes(['verify' => true]);

/*Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');*/

Route::middleware(['auth'])->group(function () {
    Route::get('/approval', [App\Http\Controllers\HomeController::class, 'approval'])->name('approval');

    Route::middleware(['approved'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
    });

    Route::middleware(['admin'])->group(function () {
        Route::get('/admin-users', [App\Http\Controllers\AdminController::class, 'admin_users']);
        Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/{user_id}/approve', [App\Http\Controllers\UserController::class, 'approve'])->name('admin.users.approve');
    });
});

