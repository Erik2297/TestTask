<?php

namespace Database\Seeders;

use App\Models\Clients;
use Illuminate\Database\Seeder;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Clients::insert([
            [
                'name' => 'Client 1',
                'cash' => 1000
            ],
            [
                'name' => 'Client 2',
                'cash' => 1000
            ],
            [
                'name' => 'Client 3',
                'cash' => 1000
            ],
        ]);
    }
}
