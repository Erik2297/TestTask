<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Stocks;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function GetStocks() {
        return response()->json([
            'stocks' => Stocks::get()
        ]);
    }

    public function GetClients() {
        return response()->json([
            'clients' => Clients::get()
        ]);
    }

    public function GetClientsStocks() {
        // return response()->json(Stocks::get());
    }

}
