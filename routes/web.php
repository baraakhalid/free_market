<?php

use App\Http\Controllers\AddressController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\FrontController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\FavoriteController;



use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupCategoryController;

// use App\Http\Controllers\MealController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Mail\VendorWelcomeEmail;
use App\Models\City;
use App\Models\OrderProduct;
use App\Models\Vendor;

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







Route::prefix('cms/')->middleware('guest:admin,vendor,user')->group(function () {
    Route::get('{guard}/login', [AuthController::class, 'showLoginView'])->name('cms.login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('forgot-password', [ResetPasswordController::class, 'showForgotPassword'])->name('password.forgot');
    Route::post('forgot-password', [ResetPasswordController::class, 'sendResetEmail'])->name('password.email');
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetPasswordView'])->name('password.reset');
    Route::post('reset-password', [ResetPasswordController::class, 'updatePassword'])->name('password.update');



});

Route::prefix('cms/admin')->middleware(['auth:admin,vendor,user', 'verified'])->group(function () {
    route::view('/' , 'cms.parent')->name('cms.dashboard');
    Route::resource('admins', AdminController::class);
    Route::resource('users', UserController::class);
    Route::resource('vendors', VendorController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('sup_categories', SupCategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('cities', CityController::class);
    Route::resource('order', OrderController::class);

    Route::get('logout', [AuthController::class, 'logout'])->name('cms.logout');

});
Route::prefix('cms/admin')->middleware(['auth:admin,vendor', 'verified'])->group(function () {
    Route::get('admins/{admin}/permissions/edit', [AdminController::class, 'editAdminPermissions'])->name('admin.edit-permissions');
    Route::put('admins/{admin}/permissions/edit', [AdminController::class, 'updateAdminPermissions']);

    Route::get('vendors/{vendor}/permissions/edit', [VendorController::class, 'editvendorPermissions'])->name('vendor.edit-permissions');
    Route::put('vendors/{vendor}/permissions/edit', [VendorController::class, 'updatevendorPermissions']);

    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::delete('notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

    Route::get('edit-password', [AuthController::class, 'editPassword'])->name('password.edit');
    Route::put('update-password', [AuthController::class, 'updatePassword']);

});

Route::prefix('cms/admin')->middleware(['auth:admin,vendor'])->group(function () {
    Route::get('verify', [EmailVerificationController::class, 'notice'])->name('verification.notice');
    Route::get('send-verification', [EmailVerificationController::class, 'send'])->middleware('throttle:1,1')->name('verification.send');
    Route::get('verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->middleware('signed')->name('verification.verify');
});

// Route::get('baraa', function () {
//     return view('front.parent');
// });

// route::prefix('cms/user')->middleware(['verified:vendor'])->group(function () {
//     Route::post('vendor', [VendorController::class,'store']);
// });

route::prefix('cms/user')->group(function () {
    Route::post('user', [UserController::class,'store']);
    Route::post('vendor', [VendorController::class,'store']);
    route::get('index' , [FrontController::class,'showproduct'])->name('front.index');
    route::view('register' , 'cms.auth.register')->name('auth.register');
    route::get('products' ,  [ProductController::class,'index'])->name('front.products');
    route::get('categories' , [CategoryController::class,'index'])->name('front.categories');
    route::get('supcategories' , [SupCategoryController::class,'index'])->name('front.supcategories');
    route::view('contact' , 'front.contact')->name('front.contact');
    Route::resource('contacts',ContactController::class);


   Route::get('logout', [AuthController::class, 'logout'])->name('cms.logout');

});
Route::prefix('cms/user')->middleware('auth:user')->group(function () {
    Route::resource('favorites', FavoriteController::class);
    Route::resource('carts', CartController::class);
    Route::resource('addresses', AddressController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('orderproducts', OrderProductController::class);






    // Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    // Route::delete('notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy'); 
    //    // route::view('contact' , 'front.contact')->name('front.contact');


});
Route::get('register', function () {
    $cities = City::all();

    return response()->view('cms.auth.registervendor', ['cities' => $cities]);
})->name('auth.registervendor');

// route::get('test',function(){
//     return new VendorWelcomeEmail( Vendor::first());
// });