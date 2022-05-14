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

// POST request
Route::post('/new_client/{data}',           [App\Http\Controllers\MainController::class,'NewClient']);
Route::post('/new_stock/{data}',            [App\Http\Controllers\MainController::class,'NewStock']);
Route::post('/delete_stock/{data}',         [App\Http\Controllers\MainController::class,'DeleteStock']);
Route::post('/update_stock/{data}',         [App\Http\Controllers\MainController::class,'UpdateStock']);
Route::post('/purchase_stock/{data}',       [App\Http\Controllers\MainController::class,'PurchaseStock']);


// GET requests
Route::get('/get_stocks',                   [App\Http\Controllers\MainController::class,'GetStocks']);
Route::get('/get_clients',                  [App\Http\Controllers\MainController::class,'GetClients']);
Route::get('/get_single_stock/{data}',      [App\Http\Controllers\MainController::class,'GetSingleStock']);
Route::get('/get_clients_stocks/{data}',    [App\Http\Controllers\MainController::class,'GetClientsStocks']);
Route::get('/purchase_stocks_clients',      [App\Http\Controllers\MainController::class,'PurchaseStocksClients']);
