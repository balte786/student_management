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
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('auth.login');
});
Route::get('/logout', function(){
    Auth::logout();
    return Redirect::to('/');
});
Route::post('/fetch-schools', [App\Http\Controllers\SchoolController::class, 'fetchSchools']);

Auth::routes(['verify' => true]);

/*Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');*/

Route::middleware(['auth'])->group(function () {
    Route::get('/approval', [App\Http\Controllers\HomeController::class, 'approval'])->name('approval');

    Route::middleware(['approved'])->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
        Route::get('/school-dashboard', [App\Http\Controllers\AdminController::class, 'school_dashboard']);
        Route::get('profile', [App\Http\Controllers\AdminController::class, 'school_profile']);
        Route::post('profile-update', [App\Http\Controllers\AdminController::class, 'school_profile_update']);

        Route::get('/school-index-list', [App\Http\Controllers\IndexManagementController::class, 'index']);
        Route::get('/school-index-upload', [App\Http\Controllers\IndexManagementController::class, 'index_upload']);
        Route::post('/school-index-import', [App\Http\Controllers\IndexManagementController::class, 'school_index_import']);
        Route::get('/school-index-approved/{id}', [App\Http\Controllers\IndexManagementController::class, 'school_index_approved']);
        Route::get('/school-index-upload-doc/{id}', [App\Http\Controllers\IndexManagementController::class, 'school_index_upload_doc']);
        Route::post('/upload-students-docs-ajax', [App\Http\Controllers\IndexManagementController::class, 'upload_student_docs_ajax']);
        Route::post('/school-index-submission/{id}', [App\Http\Controllers\IndexManagementController::class, 'school_index_submission']);
        Route::get('/approved-export-index/{id}', [App\Http\Controllers\SchoolController::class, 'approved_export_index']);
        Route::post('/upload-picture-ajax', [App\Http\Controllers\IndexManagementController::class, 'upload_picture_ajax']);


    });

    Route::middleware(['admin'])->group(function () {
        Route::get('/admin-users', [App\Http\Controllers\AdminController::class, 'admin_users']);
        Route::get('/admin-schools', [App\Http\Controllers\SchoolController::class, 'schools']);
        Route::get('/add-school', [App\Http\Controllers\SchoolController::class, 'add_school']);
        Route::post('/save-school', [App\Http\Controllers\SchoolController::class, 'save_school']);
        Route::get('/admin-school-view/{id}', [App\Http\Controllers\SchoolController::class, 'school_view']);
        Route::get('/edit-school/{id}', [App\Http\Controllers\SchoolController::class, 'edit_school']);
        Route::post('/update-school/{id}', [App\Http\Controllers\SchoolController::class, 'update_school']);
        Route::get('/delete-school/{id}', [App\Http\Controllers\SchoolController::class, 'delete_school']);
        Route::get('/admin-schools-profiles', [App\Http\Controllers\AdminController::class, 'admin_schools_profiles']);
        Route::get('/admin-schools-profiles-view/{id}', [App\Http\Controllers\AdminController::class, 'admin_schools_profiles_view']);
        Route::get('/approve-user-profile/{id}', [App\Http\Controllers\AdminController::class, 'approve_user_profile']);
        Route::get('/reject-user-profile/{id}', [App\Http\Controllers\AdminController::class, 'reject_user_profile']);
        Route::get('/admin-users/create', [App\Http\Controllers\AdminController::class, 'user_create']);
        Route::post('/admin-users/store-user', [App\Http\Controllers\AdminController::class, 'user_store']);
        Route::get('admin-users/edit/{id}',[App\Http\Controllers\AdminController::class, 'user_edit']);
        Route::post('admin-users/update', [App\Http\Controllers\AdminController::class, 'user_update']);
        Route::get('admin/profile', [App\Http\Controllers\AdminController::class, 'profile']);
        Route::post('admin/profile-update', [App\Http\Controllers\AdminController::class, 'profile_update']);
        Route::get('admin/quota', [App\Http\Controllers\AdminController::class, 'admin_quota']);
        Route::post('admin/quota-import', [App\Http\Controllers\AdminController::class, 'import']);
        Route::get('admin/admin-quota-year/{year}', [App\Http\Controllers\AdminController::class, 'admin_quota_year']);
        Route::get('admin/admin-quota-upload', [App\Http\Controllers\AdminController::class, 'quota_upload']);
        Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/{user_id}/approve', [App\Http\Controllers\UserController::class, 'approve'])->name('admin.users.approve');
        Route::get('/admin-index-list', [App\Http\Controllers\AdminController::class, 'admin_index_list']);
        Route::get('admin/export-index/{id}', [App\Http\Controllers\AdminController::class, 'export_index']);
        Route::get('/admin-index-pending/{id}', [App\Http\Controllers\AdminController::class, 'admin_index_pending']);
		Route::post('/approve-students', [App\Http\Controllers\AdminController::class, 'approve_students']);
        Route::get('/admin/index-approved/{id}', [App\Http\Controllers\AdminController::class, 'admin_index_approved']);
        Route::get('/admin/approved-index-export/{id}', [App\Http\Controllers\AdminController::class, 'admin_approved_export_index']);
        Route::get('/admin/quota-template-export/{cat_id}', [App\Http\Controllers\AdminController::class, 'quota_template_export']);


		

    });
});

