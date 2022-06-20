<?php

use App\Http\Controllers\Api\PlayerController;
use App\Http\Controllers\Api\PlayingFieldController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ReloadStationController;
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

Route::get('/players/weapons/{id}', 'PlayerWeaponController@getPlayerByWeaponId');
Route::post('/players/weapons/{id}/refill', 'PlayerWeaponController@refillWeapon');

Route::middleware('auth:sanctum')->apiResource(
    'weapons',
    WeaponController::class
);
Route::middleware('auth:sanctum')->apiResource(
    'products',
    ProductController::class
);
Route::middleware('auth:sanctum')->apiResource(
    'reloadStations',
    ReloadStationController::class
);
Route::middleware('auth:sanctum')->apiResource(
    'playingFields',
    PlayingFieldController::class
);
Route::middleware('auth:sanctum')->apiResource(
    'teams.players',
    PlayerController::class
);

Route::middleware('auth:sanctum')->get('me', 'UserController@me');

Route::middleware('auth:sanctum')->get('teams/{id}/reloadStations', 'ReloadStationController@getByTeamId');
Route::get('teams/{teamCode}/info', 'TeamCodeController@showTeamByTeamCode');
Route::get('teams/{teamCode}/weapons', 'TeamCodeController@showWeaponsByTeamCode');
Route::get('teams/{teamCode}/products', 'TeamCodeController@showProductsByTeamCode');
Route::post('teams/{teamCode}/players', 'TeamCodeController@createPlayer');
Route::middleware('auth:sanctum')->apiResource(
    'teams',
    TeamController::class
);
