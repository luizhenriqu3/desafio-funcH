<?php

use App\Http\Controllers\MovementController;
use App\Http\Controllers\UserController;
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

Route::get('/users', [UserController::class, 'all']);
Route::get('/users/{id}', [UserController::class, 'findOne']);
Route::post('/users/newUser', [UserController::class, 'create']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::get('/users/{id}/movements/{type?}', [UserController::class, 'userMovements']);
Route::get('/users/{id}/balance', [UserController::class, 'userBalance']);

Route::post('/movements/{type}', [MovementController::class, 'executeMovement']);
