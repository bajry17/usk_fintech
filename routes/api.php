<?php

use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\TransactionController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\WalletController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/addToCart', [TransactionController::class, 'addToCart'])->name('addToCart');
Route::post('/payNow', [TransactionController::class, 'payNow'])->name('payNow');
Route::post('TopUpNow', [WalletController::class, 'TopUpNow'])->name('TopUpNow');
Route::get('/download/{order_id}', [TransactionController::class, 'download'])->name('download');
Route::post('request_topup', [WalletController::class, 'request_topup'])->name('request_topup');
Route::get('/product/add', [ProductController::class, 'add'])->name('product.add');
Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
Route::get('/product/deleteProduct', [ProductController::class, 'deleteProduct'])->name('product.deleteProduct');
Route::post('/product/deleteProduct', [ProductController::class, 'deleteProductCard'])->name('product.deleteProductCard');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
Route::delete('/product/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
Route::post('/transaction/{id}',[TransactionController::class,'take'])->name('transaction.take');
Route::delete('/DeleteBaskets/{id}',[TransactionController::class,'DeleteBaskets'])->name('DeleteBaskets');
Route::resource('/user', UserController::class);
// Route::get('/data_user', [UserController::class,'index'])->name('data_user');
// Route::post('/AddUser', [UserController::class,'store'])->name('AddUser');
// Route::delete('/data_user/destroy/{id}', [UserController::class, 'destroy'])->name('data_user.destroy');
// Route::put('/data_user/update/{id}', [ProductController::class, 'update'])->name('UpdateUser');
