<?php

namespace Database\Seeders;

use App\Models\Stocks;
use Illuminate\Database\Seeder;

class StocksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Stocks::insert([
            [
                'company' => 'Company 1',
                'unit_price' => 0.7
            ],
            [
                'company' => 'Company 2',
                'unit_price' => 0.4
            ],
            [
                'company' => 'Company 3',
                'unit_price' => 2.0
            ],
        ]);
    }
}
