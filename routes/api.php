<?php

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

/*
 * Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::controller(\App\Http\Controllers\ApplicationController::class)
    ->prefix('v1/application')
    ->group(function () {

    Route::get('/{id}', 'get');
    Route::post('/create', 'create');
    Route::get('/get/last', 'getFakes');


    });

Route::controller(\App\Http\Controllers\PriceController::class)
    ->prefix('v1/coins')
    ->group(function () {

    Route::get('/available ', 'available');
    Route::get('/get', 'get');

});

Route::controller(\App\Http\Controllers\TicketController::class)
    ->prefix('v1/ticket')
    ->group(function () {

    Route::post('/create', 'create');
});
