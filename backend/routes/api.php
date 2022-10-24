<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function() {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('forgot', 'forgot');
    Route::patch('reset', 'reset');
});

Route::controller(BlogController::class)->group(function() {
    
    Route::prefix('blogs')->group(function() {
        Route::get('', 'index');
        Route::post('', 'store');
    });

    Route::prefix('blog/{id}')->group(function() {
        Route::get('', 'show');
        Route::patch('', 'update');
        Route::delete('', 'destroy');
    });
});

Route::controller(CommentController::class)->group(function() {

    Route::prefix('comments')->group(function() {
        Route::get('{id}', 'get');
        Route::post('store', 'store');
    });
});