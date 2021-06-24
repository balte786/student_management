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
        Route::get('/admin-users/create', [App\Http\Controllers\AdminController::class, 'user_create']);
        Route::post('/admin-users/store-user', [App\Http\Controllers\AdminController::class, 'user_store']);
        Route::get('admin-users/edit/{id}',[App\Http\Controllers\AdminController::class, 'user_edit']);
        Route::post('admin-users/update', [App\Http\Controllers\AdminController::class, 'user_update']);
        Route::get('admin/profile', [App\Http\Controllers\AdminController::class, 'profile']);
        Route::post('admin/profile-update', [App\Http\Controllers\AdminController::class, 'profile_update']);
        Route::get('admin/quota', [App\Http\Controllers\AdminController::class, 'admin_quota']);
        Route::post('admin/quota-import', [App\Http\Controllers\AdminController::class, 'import']);
        Route::get('admin/admin-quota-upload', [App\Http\Controllers\AdminController::class, 'quota_upload']);
        Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/{user_id}/approve', [App\Http\Controllers\UserController::class, 'approve'])->name('admin.users.approve');
    });
});

