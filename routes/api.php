<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['auth:sanctum']], function (){

    Route::get('/user/me', [\App\Http\Controllers\Api\UserController::class, 'me'])
        ->name('users.me');

    Route::get('/users', [\App\Http\Controllers\Api\UserController::class, 'index'])
        ->name('users.index');

    Route::get('/messages/{user}', [\App\Http\Controllers\Api\MessageController::class, 'listMessages'])
        ->name('message.listMesssages');

    Route::post('/messages/input', [\App\Http\Controllers\Api\MessageController::class, 'store'])
        ->name('message.store');

    Route::post('/notification/input', [\App\Http\Controllers\Api\NotificationController::class, 'store'])
        ->name('notification.store');

});
