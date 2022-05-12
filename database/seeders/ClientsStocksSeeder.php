<?php

namespace Database\Seeders;

use App\Models\ClientsStocks;
use Illuminate\Database\Seeder;

class ClientsStocksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClientsStocks::insert([
            [
                'client_id' => 1,
                'stock_id' => 1,
                'volume' => 100,
                'purchase_price' => 1
            ],
            [
                'client_id' => 1,
                'stock_id' => 1,
                'volume' => 70,
                'purchase_price' => 1
            ],
            [
                'client_id' => 1,
                'stock_id' => 2,
                'volume' => 50,
                'purchase_price' => 2
            ],
            [
                'client_id' => 2,
                'stock_id' => 1,
                'volume' => 42,
                'purchase_price' => 1
            ],
            [
                'client_id' => 2,
                'stock_id' => 2,
                'volume' => 50,
                'purchase_price' => 2
            ],
            [
                'client_id' => 3,
                'stock_id' => 1,
                'volume' => 62,
                'purchase_price' => 1
            ],
            [
                'client_id' => 3,
                'stock_id' => 3,
                'volume' => 120,
                'purchase_price' => 1.5
            ],
        ]);
    }
}
