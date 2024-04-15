<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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

// Admin route in groupe    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group( function(){
    // Admin login Route
    Route::match(['get','post'],'login',[AdminController::class, 'login'])->name('admin.login');

    // Admin dashboard Route group
    Route::middleware('admin')->group( function(){
        // admin dashboard access route
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        // Admin logout route
        Route::get('logout',[AdminController::class, 'logout'])->name('admin.logout');
        // admin update admin password route
        Route::match(['get','post'],'update-password', [AdminController::class,'updatePassword'])->name('admin.update.password');
        // admin update admin detail route
        Route::match(['get','post'],'update-details', [AdminController::class, 'updateDetails'])->name('admin.update.details');
        // Check admin detail
        Route::post('check-admin-password', [AdminController::class, 'checkAdminPassword'])->name('admin.check.password');
        // Admin users management route
        Route::get('admins/{type?}', [AdminController::class, 'adminsManagement'])->name('admins.management');


        // Vendor update detail (personal, business, bank) route
        Route::match(['get','post'], 'update-vendor-details/{slug}', [AdminController::class, 'updateVendorDetails'])->name('vendor.update.details');
        // view vender detail (personal, business, bank) route
        Route::get('view-vendor-details/{id}', [AdminController::class, 'viewVendorDetails'])->name('vendor.view.details');
        // update admin status
        Route::post('update-admin-status',[AdminController::class, 'updateAdminStatus'])->name('update.admin.status');

        // Sections
        Route::get('sections', [SectionController::class, 'index'])->name('sections.list');
        // update section status
        Route::post('update-section-status',[SectionController::class, 'updateSectionStatus'])->name('update.section.status');
        // delete section
        Route::get('delete-section/{id}',[SectionController::class, 'deleteSection'])->name('delete.section');
        // edit section
        Route::match(['get','post'],'edit-section/{id?}',[SectionController::class, 'editSection'])->name('edit.section');

        // categories
        Route::get('categories', [CategoryController::class, 'index'])->name('categories.list');
        // update categories status
        Route::post('update-category-status',[CategoryController::class, 'updateCategoryStatus'])->name('update.category.status');
        // delete categories
        Route::get('delete-category/{id}',[CategoryController::class, 'deleteCategory'])->name('delete.category');
        // edit categories
        Route::match(['get','post'],'edit-category/{id?}',[CategoryController::class, 'editCategory'])->name('edit.category');

    });

});



require __DIR__.'/auth.php';
