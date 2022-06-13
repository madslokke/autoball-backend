<?php

use App\Http\Controllers\Api\WeaponController;
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
Route::middleware('auth:sanctum')->apiResource(
    'weapons',
    WeaponController::class
);

Route::middleware('auth:sanctum')->post('/teams', 'TeamController@createTeam');

Route::get('/players/weapons/{id}', 'PlayerController@getPlayerByWeaponId');
Route::post('/players/weapons/{id}/refill', 'PlayerController@refillWeapon');

Route::post('/teams', 'TeamController@createTeam');
