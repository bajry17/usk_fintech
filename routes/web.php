<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/addToCart', [TransactionController::class, 'addToCart'])->name('addToCart');
Route::post('/payNow', [TransactionController::class, 'payNow'])->name('payNow');
Route::post('TopUpNow', [WalletController::class, 'TopUpNow'])->name('TopUpNow');
Route::get('/download/{order_id}', [TransactionController::class, 'download'])->name('download');
Route::post('request_topup', [WalletController::class, 'request_topup'])->name('request_topup');
Route::get('/product/add', [ProductController::class, 'add'])->name('product.add');
Route::put('/home/update/{id}', [ProductController::class, 'update'])->name('product.update');
Route::get('/product/deleteProduct', [ProductController::class, 'deleteProduct'])->name('product.deleteProduct');
Route::post('/product/deleteProduct', [ProductController::class, 'deleteProductCard'])->name('product.deleteProductCard');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
Route::delete('/home/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
Route::post('/transaction/{id}',[TransactionController::class,'take'])->name('transaction.take');
Route::delete('/DeleteBaskets/{id}',[TransactionController::class,'DeleteBaskets'])->name('DeleteBaskets');
