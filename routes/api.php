<?php

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

Route::get('/get_stocks',           [App\Http\Controllers\MainController::class,'GetStocks']);
Route::get('/get_clients',          [App\Http\Controllers\MainController::class,'GetClients']);
Route::get('/get_clients_stocks',   [App\Http\Controllers\MainController::class,'GetClientsStocks']);


