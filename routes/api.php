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

Route::get('/weapons/{id}', 'PlayerController@getPlayerByWeaponId');
Route::post('/weapons/{id}/refill', 'PlayerController@refillWeapon');

Route::post('/teams', 'TeamController@createTeam');
