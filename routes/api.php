<?php

use App\Http\Controllers\Api\TeamController;
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

Route::get('/players/weapons/{id}', 'PlayerController@getPlayerByWeaponId');
Route::post('/players/weapons/{id}/refill', 'PlayerController@refillWeapon');

Route::middleware('auth:sanctum')->apiResource(
    'weapons',
    WeaponController::class
);

Route::get('teams/{teamCode}/info', 'TeamCodeController@showTeamByTeamCode');
Route::get('teams/{teamCode}/weapons', 'TeamCodeController@showWeaponsByTeamCode');
Route::get('teams/{teamCode}/products', 'TeamCodeController@showProductsByTeamCode');
Route::post('teams/{teamCode}/players', 'TeamCodeController@createPlayer');
Route::middleware('auth:sanctum')->apiResource(
    'teams',
    TeamController::class
);
