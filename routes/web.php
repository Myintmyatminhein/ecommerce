<?php

use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\MustBeAdmin;
use App\Http\Middleware\MustBeLogin;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class,'index']);
Route::get('/products/{product}',[ProductController::class, 'show']); 
Route::post('/add-to-cart/{product}',[CartController::class, 'addToCart'])->middleware(MustBeLogin::class);
Route::post('/orders/store',[OrderController::class, 'store'])->middleware(MustBeLogin::class);
Route::get('/order-history',[OrderController::class, 'userOrderHistory'])->middleware(MustBeLogin::class);
Route::delete('/remove-from-cart/{product}',[CartController::class, 'removeFromCart'])->middleware(MustBeLogin::class);
Route::get('/checkout', [CheckoutController::class, 'index'])->middleware(MustBeLogin::class);
Route::get('/register',[AuthController::class, 'create']); 
Route::post('/register',[AuthController::class, 'store']); 
Route::post('/logout',[AuthController::class, 'destory']); 
Route::get('/login',[AuthController::class, 'loginform'])->name('login');
Route::post('/login',[AuthController::class, 'loginstore']);
Route::get('/admin/orders',[OrderController::class, 'adminOrder'])->middleware(MustBeAdmin::class);

Route::middleware(MustBeAdmin::class)->resource('/admin/products',AdminProductController::class);
        // ->prefix('/admin/products')
        // ->controller(AdminProductController::class)
        // ->group(function(){
        // Route::get('',  'index');
        // Route::get('/create',  'create');
        // Route::post('/', 'store');
        // Route::delete('/{product}',  'delete');
        // Route::get('/{product}/edit', 'edit');
        // Route::put('/{product}', 'update');
        // });
 Route::delete('/admin/orders/{order}',[OrderController::class, 'destroy'])->middleware(MustBeAdmin::class)->name('orders.destroy');
 Route::get('/admin/orders/{order}/edit',[OrderController::class, 'edit'])->middleware(MustBeAdmin::class)->name('orders.edit');
 Route::put('/admin/orders/{order}/update',[OrderController::class, 'update'])->middleware(MustBeAdmin::class)->name('orders.update');
Route::get('/productCreate', function () {
    return view('productCreate');
}); 




