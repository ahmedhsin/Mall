<?php

use App\Http\Controllers\DeleteController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
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
    return Inertia::Render('Home');
});

Route::get('lang/{lang}', function ($lang){
    session()->put('lang', $lang);
    return back();
});

/***************************Start Of Auth*******************************/
Route::prefix('auth')->group(function (){
    Route::get('/register', [RegisterController::class, 'create'])->name('register.create');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/login', [LoginController::class, 'create'])->name('login.create');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
    Route::post('/logout', [LoginController::class, 'destroy'])->name('login.destroy');
});
/***************************End Of Auth*******************************/



/***************************Start Of Store*******************************/
Route::post('stores/{store}/update', [\App\Http\Controllers\Store\StoreWebController::class, 'update'])->name('stores.update');
Route::resource('stores', \App\Http\Controllers\Store\StoreWebController::class)->except('update');
/***************************End Of Store*******************************/

Route::prefix('dashboard')->group(function (){
   Route::get('/', [\App\Http\Controllers\Dashboard\Store\StoreDashboardWebController::class, 'all']);
   Route::get('/stores/{store_id}', [\App\Http\Controllers\Dashboard\Store\StoreDashboardWebController::class, 'index']);
   /********************************Category***************************************/
   Route::get('/stores/{store_id}/categories', [\App\Http\Controllers\Category\CategoryWebController::class, 'index']);
   Route::post('/stores/{store_id}/categories', [\App\Http\Controllers\Category\CategoryWebController::class, 'store']);
   Route::put('/stores/{store_id}/categories', [\App\Http\Controllers\Category\CategoryWebController::class, 'update']);
   Route::delete('/stores/{store_id}/categories/{category_id}', [\App\Http\Controllers\Category\CategoryWebController::class, 'destroy']);
   /*+******************************End Category******************************************/
    Route::get('/stores/{store_id}/products', [\App\Http\Controllers\Product\ProductWebController::class, 'index']);
    Route::get('/stores/{store_id}/products/create', [\App\Http\Controllers\Product\ProductWebController::class, 'create']);
    Route::post('/stores/{store_id}/products/create', [\App\Http\Controllers\Product\ProductWebController::class, 'store']);
    Route::get('/stores/{store_id}/products/{product_id}/update', [\App\Http\Controllers\Product\ProductWebController::class, 'edit']);
    Route::post('/stores/{store_id}/products/{product_id}/update', [\App\Http\Controllers\Product\ProductWebController::class, 'update']);
    Route::delete('/stores/{store_id}/products/{product_id}', [\App\Http\Controllers\Product\ProductWebController::class, 'destroy']);


    /**********************************Orders****************************/
    Route::get('/stores/{store_id}/orders', [\App\Http\Controllers\Order\OrderWebController::class, 'orders']);


});


Route::prefix('stores')->group(function (){
    Route::get('/{store_id}/products', [\App\Http\Controllers\Product\ProductWebController::class, 'products']);
    Route::get('/{store_id}/products/{product_id}', [\App\Http\Controllers\Product\ProductWebController::class, 'show']);
});

Route::get('/cart', function (){
    return Inertia::render('Client/Cart');
});

Route::resource('checkout', \App\Http\Controllers\Checkout\CheckoutWebController::class);
Route::resource('orders', \App\Http\Controllers\Order\OrderWebController::class);



Route::post('/remove', DeleteController::class);
