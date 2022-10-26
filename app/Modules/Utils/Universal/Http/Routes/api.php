<?php

use App\Http\Controllers\V1\Admin\UniversalController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api/admin', 'middleware' => ['api','jwt.auth' , 'panel']], function () {
    Route::get('/universal/{model}', [UniversalController::class, 'index']);
    Route::get('/universal/{model}/{id}', [UniversalController::class, 'show']);
    Route::post('/universal/{model}', [UniversalController::class, 'store']);
    Route::patch('/universal/{model}/{id}', [UniversalController::class, 'update']);
    Route::delete('/universal/{model}', [UniversalController::class, 'delete']);
});
