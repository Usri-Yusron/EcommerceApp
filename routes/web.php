<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'home']);

Route::get('/dashboard', [HomeController::class, 'login_home'])->middleware(['auth', 'verified'])->name('dashboard');

// route my orders
Route::get('/myorders', [HomeController::class, 'myorders'])->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// route admin
Route::get('admin/dashboard', [HomeController::class, 'index'])->
    middleware(['auth', 'admin']);

// route admin view kategory
Route::get('view_category', [AdminController::class, 'view_category'])->
    middleware(['auth', 'admin']);
    
// route admin add kategory
Route::post('add_category', [AdminController::class, 'add_category'])->
    middleware(['auth', 'admin']);
    
// route delete kategory
Route::get('delete_category/{id}', [AdminController::class, 'delete_category'])->
    middleware(['auth', 'admin']);

// route edit kategory
Route::get('edit_category/{id}', [AdminController::class, 'edit_category'])->
    middleware(['auth', 'admin']);
// route save edit kategory
Route::post('update_category/{id}', [AdminController::class, 'update_category'])->
    middleware(['auth', 'admin']);

// route view product
Route::get('view_product', [AdminController::class, 'view_product'])->
    middleware(['auth', 'admin']);

// route add product
Route::get('add_product', [AdminController::class, 'add_product'])->
    middleware(['auth', 'admin']);

// route save add product
Route::post('upload_product', [AdminController::class, 'upload_product'])->
    middleware(['auth', 'admin']);

// route edit product
Route::get('update_product/{id}', [AdminController::class, 'update_product'])->
middleware(['auth', 'admin']);

// route save edit product
Route::post('edit_product/{id}', [AdminController::class, 'edit_product'])->
middleware(['auth', 'admin']);

// route delete product
Route::get('delete_product/{id}', [AdminController::class, 'delete_product'])->
middleware(['auth', 'admin']);

// route search product
Route::get('product_search', [AdminController::class, 'product_search'])->
middleware(['auth', 'admin']);

// route detail product for user
Route::get('product_details/{id}', [HomeController::class, 'product_details']);

// route add to cart
Route::get('add_cart/{id}', [HomeController::class, 'add_cart'])->middleware(['auth', 'verified']);

// route add to cart detail (mycart)
Route::get('mycart', [HomeController::class, 'mycart'])->middleware(['auth', 'verified']);

// route delete cart
Route::get('delete_cart/{id}', [HomeController::class, 'delete_cart'])->
middleware(['auth', 'verified']);

// route confirm order
Route::post('comfirm_order', [HomeController::class, 'comfirm_order'])->
middleware(['auth', 'verified']);

// route view orders admin
Route::get('view_order', [AdminController::class, 'view_order'])->
middleware(['auth', 'admin']);

// route status on the way
Route::get('on_the_way/{id}', [AdminController::class, 'on_the_way'])->
middleware(['auth', 'admin']);

// route status delivered
Route::get('delivered/{id}', [AdminController::class, 'delivered'])->
middleware(['auth', 'admin']);

// route donwload pdf
Route::get('print_pdf/{id}', [AdminController::class, 'print_pdf'])->
middleware(['auth', 'admin']);

// buat gateway payment
Route::controller(HomeController::class)->group(function(){
    Route::get('stripe/{value}', 'stripe');
    Route::post('stripe/{value}', 'stripePost')->name('stripe.post');
});