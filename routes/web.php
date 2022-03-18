<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\UserController;
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
    
    Route::group(['prefix' => 'cars', 'middleware' => 'auth:sanctum'], function() {
        Route::post('/', [CarController::class, 'store']);
        Route::delete('/{id}', [CarController::class, 'delete']);
    });

    Route::group(['prefix' => 'users'], function() {
        Route::post('/', [UserController::class, 'store']);
        Route::put('/verify', [UserController::class, 'verifyEmail']);
        Route::post('/login', [AuthController::class, 'login']);
        
        Route::group(['middleware' => 'auth:sanctum'], function() {
            Route::delete('/logout', [AuthController::class, 'logout']);
            Route::put('/', [UserController::class, 'update']);
        });
    });
    
});

