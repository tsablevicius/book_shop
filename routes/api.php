<?php

use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\ReviewController;
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

Route::prefix('v1')->group(function () {
    Route::get('books', [BookController::class, 'getBooks']);
    Route::get('books/{id}', [BookController::class, 'getBook']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('books/{id}/reviews', [BookController::class, 'getReviews']);
        Route::post('books/reviews/create', [ReviewController::class, 'store']);
    });
});
