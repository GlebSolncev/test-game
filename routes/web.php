<?php

use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\WelcomeController;
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

Route::get('/', [WelcomeController::class, 'home'])->name('home');


Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
    Route::post('register', [UserController::class, 'register'])->name('register');

    Route::group(['middleware' => 'user.valid'], function(){
        Route::get('{slug}', [UserController::class, 'profile'])->name('detail');
        Route::get('{slug}/new-link', [UserController::class, 'newLink'])->name('new-link');
        Route::get('{slug}/delete', [UserController::class, 'deleteLink'])->name('delete');
    });
});