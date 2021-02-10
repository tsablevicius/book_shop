<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::resource('books', BookController::class);
Route::post('confirm', [BookController::class, 'confirm'])->name('books.confirm');

Auth::routes();

Route::get('/profile', [UserController::class, 'profile'])->name('profile');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/books', [UserController::class, 'adminWithAllBooks'])->name('admin.books');

});

Route::get('/home', [HomeController::class, 'index'])->name('home');

