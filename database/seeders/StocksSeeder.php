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
                'unit_price' => 0.3
            ],
            [
                'company' => 'Company 2',
                'unit_price' => 1.00
            ],
            [
                'company' => 'Company 3',
                'unit_price' => 2.00
            ],
        ]);
    }
}
