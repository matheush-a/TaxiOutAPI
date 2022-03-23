<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\UserController;
use App\Models\Booking;
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
    return view('emails.verify-email', ['user' => ['name' => 'Miranha'], 'link' => '']);
});

Route::group(['prefix' => 'api'], function() {   
    Route::get('/token', function(){
        return csrf_token();
    });

    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::group(['prefix' => 'users'], function() {
            Route::delete('/logout', [AuthController::class, 'logout']);
            Route::put('/', [UserController::class, 'update']);
        });

        Route::group(['prefix' => 'cars'], function() {
            Route::post('/', [CarController::class, 'store']);
            Route::delete('/{id}', [CarController::class, 'delete']);
            Route::get('/', [CarController::class, 'index']);
            Route::get('/{id}', [CarController::class, 'show']);
        });

        Route::group(['prefix' => 'trips'], function() {
            Route::post('/', [TripController::class, 'store']);
            Route::get('/', [TripController::class, 'index']);
            Route::get('/{id}', [TripController::class, 'show']);
        });

        Route::group(['prefix' => 'bookings'], function() {
            Route::post('/', [BookingController::class, 'store']);
            Route::delete('/{id}', [BookingController::class, 'delete']);
            Route::get('/{id}', [BookingController::class, 'show']);
            Route::get('/', [BookingController::class, 'index']);
        });
    });

    Route::group(['prefix' => 'users'], function() {
        Route::post('/', [UserController::class, 'store']);
        Route::put('/verify', [UserController::class, 'verifyEmail']);
        Route::post('/login', [AuthController::class, 'login']);
    });
    
});

