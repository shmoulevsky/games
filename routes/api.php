<?php

use App\Http\Controllers\V1\Admin\GameController;
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

Route::group(['prefix' => 'admin', 'middleware' => ['jwt.auth' , 'panel']], function () {
    Route::resource('users', UserController::class);
    Route::resource('games', GameController::class);
});

Route::get('games/{code}', [\App\Http\Controllers\V1\Pub\Game\GameController::class, 'detail']);
Route::get('games', [\App\Http\Controllers\V1\Pub\Game\GameController::class, 'index']);
Route::get('app', [\App\Http\Controllers\V1\Pub\App\AppController::class, 'index']);
Route::get('url', [\App\Http\Controllers\V1\Pub\App\UrlController::class, 'index']);
