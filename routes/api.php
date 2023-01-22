<?php

use App\Http\Controllers\V1\Admin\AppController;
use App\Http\Controllers\V1\Admin\GameCategoryController;
use App\Http\Controllers\V1\Admin\GameController;
use App\Http\Controllers\V1\Admin\SettingsController;
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
    Route::get('app', [AppController::class, 'index']);
    Route::resource('users', UserController::class);
    Route::resource('games', GameController::class);
    Route::get('game-categories/select', [GameCategoryController::class, 'select']);
    Route::resource('game-categories', GameCategoryController::class);

    Route::get('settings/{key}', [SettingsController::class, 'show']);
    Route::post('settings/key/{key}', [SettingsController::class, 'updateByKey']);

});

Route::get('app', [\App\Http\Controllers\V1\Pub\App\AppController::class, 'index']);
Route::get('url', [\App\Http\Controllers\V1\Pub\App\UrlController::class, 'index']);
Route::get('tags', [\App\Http\Controllers\V1\Pub\App\TagController::class, 'index']);

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['api']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
