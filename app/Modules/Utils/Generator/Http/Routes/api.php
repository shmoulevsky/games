<?php

use App\Modules\Utils\Generator\Http\Controllers\GeneratorController;
use App\Modules\Utils\Generator\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api/admin/generator', 'middleware' => ['api','jwt.auth' , 'panel']], function () {
    Route::post('list-handle', [GeneratorController::class, 'list']);
    Route::post('form-handle', [GeneratorController::class, 'form']);
    Route::get('tables', [TableController::class, 'tables']);
    Route::get('table/{table}', [TableController::class, 'table']);
    Route::get('info/list/{table}', [TableController::class, 'listSettings']);
});
