<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
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
});