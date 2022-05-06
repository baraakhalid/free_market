<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;



use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupCategoryController;

// use App\Http\Controllers\MealController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\Auth\AuthController;
         

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
// ->middleware(['auth:admin , user ,vendor'])
Route::prefix('cms/')->middleware('guest:admin,vendor')->group(function () {
    Route::get('{guard}/login', [AuthController::class, 'showLoginView'])->name('cms.login');
    Route::post('login', [AuthController::class, 'login']);

});

Route::prefix('cms/admin')->middleware('auth:admin,vendor,user')->group(function () {
    route::view('/' , 'cms.parent');
    Route::resource('admins', AdminController::class);
    Route::resource('users', UserController::class);
    Route::resource('vendors', VendorController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('sup_categories', SupCategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('cities', CityController::class);
    Route::get('logout', [AuthController::class, 'logout'])->name('cms.logout');

});
Route::prefix('cms/admin')->middleware('auth:admin,vendor')->group(function () {
    Route::get('admins/{admin}/permissions/edit', [AdminController::class, 'editAdminPermissions'])->name('admin.edit-permissions');
    Route::put('admins/{admin}/permissions/edit', [AdminController::class, 'updateAdminPermissions']);
    Route::get('vendors/{vendor}/permissions/edit', [VendorController::class, 'editvendorPermissions'])->name('vendor.edit-permissions');
    Route::put('vendors/{vendor}/permissions/edit', [VendorController::class, 'updatevendorPermissions']);


});

// Route::get('baraa', function () {
//     return view('front.index');
// });
route::prefix('cms/user')->group(function () {
    Route::post('users', [UserController::class,'store']);
    // Route::post('vendor', [vendorController::class,'store']);
    Route::get('index', [HomeController::class, 'index']);



   
//    Route::get('logout', [AuthController::class, 'logout'])->name('cms.logout');

});

