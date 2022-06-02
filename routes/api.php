<?php

use App\Http\Controllers\Api\PlayerController;
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

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');


Route::get('/weapons/{id}', 'PlayerController@getPlayerByWeaponId');
Route::post('/weapons/{id}/refill', 'PlayerController@refillWeapon');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', 'AuthController@me');
});
