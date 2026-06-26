<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseAddressController;
use App\Http\Controllers\PurchaseController;
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

Route::get('/', [ItemController::class, 'index'])->name('item.index');
Route::get('/item/{item}', [ItemController::class, 'show'])->name('item.show');
Route::get('/mypage/profile', function () {
    return view('profile.edit');
})->middleware('auth')->name('profile.edit');

Route::middleware('auth')->group(function () {
    Route::post('/item/{item}/comment', [CommentController::class, 'store'])
        ->name('comment.store');

    Route::post('/item/{item}/favorite', [FavoriteController::class, 'toggle'])
        ->name('favorite.toggle');

    Route::get('/purchase/{item}', [PurchaseController::class, 'show'])
        ->name('purchase.show');

    Route::get('/purchase/address/{item}', [PurchaseAddressController::class, 'edit'])
        ->name('purchase.address.edit');

    Route::patch('/purchase/address/{item}', [PurchaseAddressController::class, 'update'])
        ->name('purchase.address.update');

    Route::post('/purchase/{item}', [PurchaseController::class, 'store'])
        ->name('purchase.store');

    Route::get('/mypage', [ProfileController::class, 'index'])
        ->name('mypage.index');

});
