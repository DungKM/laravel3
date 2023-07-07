<?php

use App\Http\Controllers\CouponController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Coupon;
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

Route::get('/',function(){
    return view('admin.layouts.main');
});


Route::resource('roles',RoleController::class);
Route::resource('users',UserController::class);
Route::resource('categories',CategoryController::class)->except([
    'show',
]);
Route::resource('products',ProductController::class);
Route::resource('coupons',CouponController::class)->except([
    'show',
]);
Route::get('coupons/api', [CouponController::class, 'api'])->name('coupon.api');
Route::get('categories/api', [CategoryController::class, 'api'])->name('category.api');