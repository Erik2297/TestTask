<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PDO;
use PDOException;
use Illuminate\Support\Facades\DB;
use mysqli;

class CreateDatabase extends Command
{
   /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'db:create';

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'This command creates a new database';

    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'db:create';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $servername = env('DB_HOST');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');

        // Create connection
        $conn = new mysqli($servername, $username, $password);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Create database
        $sql_drop = "DROP DATABASE IF EXISTS ".env('DB_DATABASE');
        $sql_create = "CREATE DATABASE ".env('DB_DATABASE');
        if ($conn->query($sql_drop) === TRUE && $conn->query($sql_create) === TRUE) {
            echo "Database created successfully";
        } else {
            echo "Error creating database: " . $conn->error;
        }
        $conn->close();
    }

}
