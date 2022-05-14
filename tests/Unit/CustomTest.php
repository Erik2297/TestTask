<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\DatabaseSeeder;

class CustomTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;
    protected $seed = true;

    public function test_database_creation(){
        $this->artisan('db:create')->assertSuccessful();
        $this->runDatabaseMigrations();
        $this->seed(DatabaseSeeder::class);
    }

    public function test_database_clients(){
        $this->assertDatabaseCount('clients', 3);
    }

    public function test_database_stocks(){
        $this->assertDatabaseCount('stocks', 3);
    }

    public function test_home()
    {
        $response = $this->get('/');
        $response->assertOK(true);
    }

    public function test_stocks()
    {
        $response = $this->get('/get_stocks');
        $response->assertOK(true);
    }

    public function test_clients()
    {
        $response = $this->get('/get_clients');
        $response->assertOK(true);
    }

    public function test_single_stock()
    {
        $response = $this->get('/get_single_stocks/1');
        $response->assertOK(true);
    }

    public function test_clients_stock()
    {
        $response = $this->get('/get_clients_stocks/2');
        $response->assertOK(true);
    }

    public function test_purchase_stocks_clients()
    {
        $response = $this->get('/purchase_stocks_clients');
        $response->assertOK(true);
    }


    public function test_new_client()
    {
        $data = [
            'username' => 'test',
        ];
        $response = $this->get('/new_client/{data}');
        $response->assertOK(true);
    }

}
