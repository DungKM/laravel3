<?php

use App\Http\Controllers\CouponController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;
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
// Admin
Route::get('/dash', function () {
    return view('admin.layouts.main');
});
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
Route::resource('categories', CategoryController::class)->except([
    'show',
]);
Route::resource('products', ProductController::class);
Route::resource('coupons', CouponController::class)->except([
    'show',
]);
Auth::routes();

//Client
Route::get('/', [HomeController::class, 'index']);
Route::get('/product', [ClientProductController::class, 'index'])->name('client.product.index');
Route::get('product/{category_id}', [ClientProductController::class, 'category_product'])->name('client.products.categoryid');
Route::get('product-detail/{id}', [ClientProductController::class, 'show'])->name('client.product.show');




Route::middleware('auth')->group(function () {
    Route::post('add-to-cart', [CartController::class, 'store'])->name('client.carts.add');
    Route::get('carts', [CartController::class, 'index'])->name('client.carts.index');
    Route::post('update-quantity-product-in-cart/{cart_product_id}', [CartController::class, 'updateQuantityProduct'])->name('client.carts.update_product_quantity');
    Route::post('remove-product-in-cart/{cart_product_id}', [CartController::class, 'removeProductInCart'])->name('client.carts.remove_product');
    Route::post('apply-coupon', [CartController::class, 'applyCoupon'])->name('client.carts.apply_coupon');
    Route::get('checkout', [CartController::class, 'checkout'])->name('client.checkout.index');

    Route::post('process-checkout', [CartController::class, 'processCheckout'])->name('client.checkout.proccess');
});


// ApiDatatable
Route::get('coupons/api', [CouponController::class, 'api'])->name('coupon.api');
Route::get('categories/api', [CategoryController::class, 'api'])->name('category.api');
Route::get('products/api', [CategoryController::class, 'api'])->name('product.api');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
