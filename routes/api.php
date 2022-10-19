<?php

use App\Http\Controllers\V1\Admin\UserController;
use App\Http\Controllers\V1\Pub\User\AuthController;
use App\Http\Controllers\V1\Pub\User\RegisterController;
use App\Http\Controllers\V1\Pub\User\RestoreController;
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

Route::middleware('throttle:60,1')->group(function() {
    Route::post('login', [AuthController::class, 'login']);
    Route::get('refresh', [AuthController::class, 'refresh']);
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('restore', [RestoreController::class, 'restore']);
});

Route::group(['prefix' => 'admin', 'middleware' => ['jwt.auth']], function () {
    Route::resource('users', UserController::class);
});

