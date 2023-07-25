<?php

use App\Http\Controllers\OrderController;
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
Route::middleware('auth')->group(function () {
    Route::get('/dash', function () {
        return view('admin.layouts.main');
    })->name('dash');
    // Route::resource('roles', RoleController::class);
    // Route::resource('users', UserController::class);
    Route::prefix('roles')->controller(RoleController::class)->name('roles.')->group(function () {
        Route::get('/', 'index')->name('index')->middleware('role:super-admin');
        Route::post('/', 'store')->name('store')->middleware('role:super-admin');
        Route::get('/create', 'create')->name('create')->middleware('role:super-admin');
        Route::get('/{role}', 'show')->name('show')->middleware('role:super-admin');
        Route::put('/{role}', 'update')->name('update')->middleware('role:super-admin');
        Route::delete('/{role}', 'destroy')->name('destroy')->middleware('role:super-admin');
        Route::get('/{role}/edit', 'edit')->name('edit')->middleware('role:super-admin');
    });

    // Route::resource('categories', CategoryController::class)->except([
    //     'show',
    // ]);
    Route::prefix('users')->controller(UserController::class)->name('users.')->group(function () {
        Route::get('/', 'index')->name('index')->middleware('permission:show-user');
        Route::post('/', 'store')->name('store');
        Route::get('/create', 'create')->name('create')->middleware('permission:create-user');
        Route::get('/{user}', 'show')->name('show')->middleware('permission:show-user');
        Route::put('/{user}', 'update')->name('update')->middleware('permission:update-user');
        Route::delete('/{user}', 'destroy')->name('destroy')->middleware('permission:delete-user');
        Route::get('/{user}/edit', 'edit')->name('edit')->middleware('permission:update-user');
    });

    Route::prefix('categories')->controller(CategoryController::class)->name('categories.')->group(function () {
        Route::get('/', 'index')->name('index')->middleware('permission:show-category');
        Route::post('/', 'store')->name('store')->middleware('permission:create-category');
        Route::get('/create', 'create')->name('create')->middleware('permission:create-category');
        Route::get('/{category}', 'show')->name('show')->middleware('permission:show-category');
        Route::put('/{category}', 'update')->name('update')->middleware('permission:update-category');
        Route::delete('/{category}', 'destroy')->name('destroy')->middleware('permission:delete-category');
        Route::get('/{category}/edit', 'edit')->name('edit')->middleware('permission:update-category');
    });

    // Route::resource('products', ProductController::class);
    Route::prefix('products')->controller(ProductController::class)->name('products.')->group(function () {
        Route::get('/', 'index')->name('index')->middleware('permission:show-product');
        Route::post('/', 'store')->name('store')->middleware('permission:create-product');
        Route::get('/create', 'create')->name('create')->middleware('permission:create-product');
        Route::get('/{product}', 'show')->name('show')->middleware('permission:show-product');
        Route::put('/{product}', 'update')->name('update')->middleware('permission:update-product');
        Route::delete('/{product}', 'destroy')->name('destroy')->middleware('permission:delete-product');
        Route::get('/{product}/edit', 'edit')->name('edit')->middleware('permission:update-product');
    });

    // Route::resource('coupons', CouponController::class)->except([
    //     'show',
    // ]);
    Route::prefix('coupons')->controller(CouponController::class)->name('coupons.')->group(function () {
        Route::get('/', 'index')->name('index')->middleware('permission:show-coupon');
        Route::post('/', 'store')->name('store')->middleware('permission:create-coupon');
        Route::get('/create', 'create')->name('create')->middleware('permission:create-coupon');
        Route::get('/{coupon}', 'show')->name('show')->middleware('permission:show-coupon');
        Route::put('/{coupon}', 'update')->name('update')->middleware('permission:update-coupon');
        Route::delete('/{coupon}', 'destroy')->name('destroy')->middleware('permission:delete-coupon');
        Route::get('/{coupon}/edit', 'edit')->name('edit')->middleware('permission:update-coupon');
    });
    Route::get('orders', [OrderController::class, 'index'])->name('admin.orders.index')->middleware('permission:list-order');
    Route::post('update-status/{id}', [OrderController::class, 'updateStatus'])->name('admin.orders.update_status')->middleware('permission:update-order-status');
});







Auth::routes();

//Client
Route::get('/', [HomeController::class, 'index'])->name('home');
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