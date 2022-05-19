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
Route::post('/new_client/{data}',           [App\Http\Controllers\ClientController::class,'NewClient']);
Route::post('/new_stock/{data}',            [App\Http\Controllers\StockController::class,'NewStock']);
Route::post('/delete_stock/{data}',         [App\Http\Controllers\StockController::class,'DeleteStock']);
Route::post('/update_stock/{data}',         [App\Http\Controllers\StockController::class,'UpdateStock']);
Route::post('/purchase_stock/{data}',       [App\Http\Controllers\StockController::class,'PurchaseStock']);


// GET requests
Route::get('/get_stocks',                   [App\Http\Controllers\StockController::class,'GetStocks']);
Route::get('/get_clients',                  [App\Http\Controllers\ClientController::class,'GetClients']);
Route::get('/get_single_stock/{data}',      [App\Http\Controllers\StockController::class,'GetSingleStock']);
Route::get('/get_clients_stocks/{data}',    [App\Http\Controllers\ClientController::class,'GetClientsStocks']);
Route::get('/purchase_stocks_clients',      [App\Http\Controllers\ClientController::class,'PurchaseStocksClients']);
