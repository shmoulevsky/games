<?php

use App\Http\Controllers\V1\Admin\AppController;
use App\Http\Controllers\V1\Admin\GameCategoryController;
use App\Http\Controllers\V1\Admin\GameController;
use App\Http\Controllers\V1\Admin\PropertyController;
use App\Http\Controllers\V1\Admin\SettingsController;
use App\Http\Controllers\V1\Admin\TagController;
use App\Http\Controllers\V1\Admin\TranslateController;
use App\Http\Controllers\V1\Admin\UserController;
use App\Http\Controllers\V1\Pub\User\AuthController;
use App\Http\Controllers\V1\Pub\User\OAuthController;
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
    Route::post('oauth/link', [OAuthController::class, 'getLink']);
    Route::post('oauth/login', [OAuthController::class, 'login']);

    Route::post('login', [AuthController::class, 'login']);
    Route::get('refresh', [AuthController::class, 'refresh']);
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('register/quick', [RegisterController::class, 'registerQuick']);
    Route::get('register/email/verify/{hash}', [RegisterController::class, 'verify']);
    Route::post('restore', [RestoreController::class, 'restore']);
});

Route::group(['prefix' => 'admin', 'middleware' => ['jwt.auth' , 'panel']], function () {

    Route::get('app', [AppController::class, 'index']);
    Route::resource('users', UserController::class);
    Route::resource('games', GameController::class);
    Route::resource('tags', TagController::class);
    Route::resource('properties', PropertyController::class);

    Route::get('game-categories/select', [GameCategoryController::class, 'select']);
    Route::resource('game-categories', GameCategoryController::class);

    Route::get('settings/{key}', [SettingsController::class, 'show']);
    Route::post('settings/key/{key}', [SettingsController::class, 'updateByKey']);

    Route::post('translate', [TranslateController::class, 'translate']);

});

Route::get('app', [\App\Http\Controllers\V1\Pub\AppController::class, 'index']);
Route::get('url', [\App\Http\Controllers\V1\Pub\UrlController::class, 'index']);
Route::get('tags', [\App\Http\Controllers\V1\Pub\TagController::class, 'index']);
Route::get('comments/{entity_type}/{entity_id}', [\App\Http\Controllers\V1\Pub\CommentController::class, 'show']);
Route::post('comments', [\App\Http\Controllers\V1\Pub\CommentController::class, 'store']);
Route::post('statistic', [\App\Http\Controllers\V1\Pub\User\StatisticController::class, 'store']);

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['api']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
