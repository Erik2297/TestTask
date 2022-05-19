<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\ClientsStocks;
use App\Models\Stocks;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    public function GetClients() {
        $clients = Clients::with('stocks')->get();
        return response()->json([
            'clients' => $clients
        ]);
    }

    public function NewClient($data){
        $data = json_decode($data,true);
        $validate = validator()->make(
            $data,
            [
                'username' => 'required',
            ]
        );
        if($validate->fails()){
            return response()->json([
                'status' => '200',
                'errors' => $validate->errors()
            ]);
        }
        else{
            $client = new Clients();
            $client->name = $data['username'];
            $client->save();
            $new_client = Clients::where('id' , $client->id)->with('stocks')->first();
            return response()->json([
                'status' => '200',
                'request-status' => 'new-client-added',
                'new_client' => $new_client
            ]);
        }
    }

    public function PurchaseStocksClients(){
        return response()->json([
            'clients' => Clients::all(),
            'stocks' => Stocks::all(),
        ]);
    }

    public function GetClientsStocks($client_id) {
        $client = Clients::where('id', $client_id)->first();
        if(empty($client)){
            return response()->json([
                'no_user' => '',
            ]);
        }
        else{
            $data = ClientsStocks::with('stock','client')->where('client_id' , $client_id)->get();
            return response()->json([
                'stocks' => $data,
                'client' => $client,
            ]);
        }
    }

}
