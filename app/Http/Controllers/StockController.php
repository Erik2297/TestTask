<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\ClientsStocks;
use App\Models\Stocks;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function GetStocks() {
        return response()->json([
            'stocks' => Stocks::get()
        ]);
    }

    public function NewStock($data){
        $data = json_decode($data,true);
        $validate = validator()->make(
            $data,
            [
                'company' => 'required',
                'unit_price' => 'required|numeric|gt:0',
            ]
        );
        if($validate->fails()){
            return response()->json([
                'status' => '200',
                'errors' => $validate->errors()
            ]);
        }
        else{
            $stock = new Stocks();
            $stock->company = $data['company'];
            $stock->unit_price = $data['unit_price'];
            // $stock->updated_at = Carbon::now();
            $stock->save();
            $new_stock = Stocks::where('id' , $stock->id)->first();
            return response()->json([
                'status' => '200',
                'request-status' => 'new-stock-added',
                'new_stock' => $new_stock
            ]);
        }
    }

    public function DeleteStock($stock_id){
        $check = Stocks::where('id' , $stock_id)->delete();
        if($check){
            return response()->json([
                'status' => 200,
                'request-status' => 'stock-is-deleted',
            ]);
        }
        else{
            return response()->json([
                'status' => 200,
                'request-status' => 'error',
            ]);
        }
    }

    public function GetSingleStock($stock_id){
        $stock = Stocks::where('id' , $stock_id)->get();
        if(!empty($stock)){
            return response()->json([
                'status' => 200,
                'request-status' => 'single-stock',
                'stock' => $stock
            ]);
        }
        else{
            return response()->json([
                'status' => 200,
                'request-status' => 'error',
            ]);
        }
    }

    public function UpdateStock($data){
        $data = json_decode($data,true);
        $validate = validator()->make(
            $data,
            [
                'unit_price' => 'required|numeric|gt:0',
            ]
        );
        if($validate->fails()){
            return response()->json([
                'status' => '200',
                'errors' => $validate->errors()
            ]);
        }
        else{
            $stock = Stocks::where('id' , $data['id'])->first()->update([
                'unit_price' => $data['unit_price'],
                'updated_at' => Carbon::now(),
            ]);
            return response()->json($stock);
        }
    }

    public function PurchaseStock($data){
        $data = json_decode($data,true);
        $validate = validator()->make(
            $data,
            [
                'client_id' => 'required|numeric',
                'stock_id' => 'required|numeric',
                'volume' => 'required|numeric|gt:0',
            ]
        );
        if($validate->fails()){
            return response()->json([
                'status' => '200',
                'errors' => $validate->errors()
            ]);
        }
        else{
            $stock = Stocks::where('id', $data['stock_id'])->first();
            $purchase_price = $stock->unit_price;

            $clientspurchase = new ClientsStocks();
            $clientspurchase->client_id = $data['client_id'];
            $clientspurchase->stock_id = $data['stock_id'];
            $clientspurchase->volume = $data['volume'];
            $clientspurchase->purchase_price = $purchase_price;
            $clientspurchase->save();

            $client = Clients::where('id' , $data['client_id'])->first();
            $currentCash = $client->cash;
            $portfolioDecrease = $data['volume'] * $stock->unit_price;
            if( $currentCash >= $portfolioDecrease ){
                $updated_cash = $currentCash - $portfolioDecrease;
                $client->update([
                    'cash' => $updated_cash
                ]);
            }
            else{
                return response()->json([
                    'status' => '200',
                    'errors' => [
                        'not_enough' => 'The cash is not enough to make a purchase'
                    ]
                ]);
            }
            return response()->json([
                'status' => '200',
                'request-status' => 'new-purchase-made',
            ]);
        }
    }

}
