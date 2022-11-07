<?php

use App\Http\Controllers\Api\V1\GameController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1', 'as' => 'api.v1.'], function(){
    Route::group(['prefix' => '{slug}', 'as' => 'game.'], function () {
        Route::get('history', [GameController::class, 'history'])->name('history');
        Route::post('play', [GameController::class, 'play'])->name('play');
    });
});
