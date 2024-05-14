<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\OwnerAuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([
    //'middleware' => 'api',
    'prefix' => 'auth/admin'
], function ($router) {
    Route::post('/login', [AdminController::class, 'login']);
    Route::post('/register', [AdminController::class, 'register']);
    Route::post('/logout', [AdminController::class, 'logout']);
    Route::post('/refresh', [AdminController::class, 'refresh']);
    Route::get('/user-profile', [AdminController::class, 'userProfile']);
});

Route::group([
    //'middleware' => 'api',
    'prefix' => 'auth/owner'
], function ($router) {
    Route::post('/login', [OwnerAuthController::class, 'login']);
    Route::post('/register', [OwnerAuthController::class, 'register']);
    Route::post('/logout', [OwnerAuthController::class, 'logout']);
    Route::post('/refresh', [OwnerAuthController::class, 'refresh']);
    Route::get('/user-profile', [OwnerAuthController::class, 'userProfile']);
});
Route::group([
    //'middleware' => 'api',
    'prefix' => 'auth/client'
], function ($router) {
    Route::post('/login', [ClientController::class, 'login']);
    Route::post('/register', [ClientController::class, 'register']);
    Route::post('/logout', [ClientController::class, 'logout']);
    Route::post('/refresh', [ClientController::class, 'refresh']);
    Route::get('/user-profile', [ClientController::class, 'userProfile']);
});


Route::apiResource('posts', \App\Http\Controllers\PostController::class);
Route::post('/post/{owner_id}',[\App\Http\Controllers\PostController::class,'save']);
