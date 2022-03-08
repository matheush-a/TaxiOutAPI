<?php

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

Route::group(['prefix' => 'api'], function() {   
    Route::get('/token', function(){
        return csrf_token();
    });
    
    Route::group(['prefix' => 'users'], function() {
        Route::post('/', [UserController::class, 'store']);
    });
});

